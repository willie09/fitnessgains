<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Sale;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $thresholdDate = $today->copy()->addDays(7);
        $members = \App\Models\Member::with('user')->where('expiry_date', '>=', $today)->orderBy('created_at', 'DESC')->get();
        $expiringMembers = \App\Models\Member::with('user')->whereBetween('expiry_date', [$today, $thresholdDate])->get();
        $expiredMembers = \App\Models\Member::with('user')->where('expiry_date', '<', $today)->orderBy('expiry_date', 'DESC')->get();
        $membershipPrices = [
            'basic' => 500,
            'premium' => 700,
            'vip' => 1000,
        ];
        return view('admin.member-list', [
            'members' => $members,
            'expiringMembers' => $expiringMembers,
            'expiredMembers' => $expiredMembers,
            'membershipPrices' => $membershipPrices
        ]);
    }

    public function notifyExpiryForm()
    {
        return view('members.notify-expiry');
    }

    public function sendExpiryNotifications()
    {
        $today = now()->startOfDay();
        $thresholdDate = $today->copy()->addDays(7);

        $members = \App\Models\Member::whereBetween('expiry_date', [$today, $thresholdDate])->get();

        foreach ($members as $member) {
            $member->notify(new \App\Notifications\MembershipExpiryNotification($member));
        }

        return redirect()->route('members.notifyExpiryForm')->with('success', 'Notification emails sent successfully.');
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:members,email|unique:users,email',
                'contact_number' => 'nullable|string|max:20',
                'gender' => 'nullable|in:male,female,other',
                'date_of_birth' => 'nullable|date|before:today',
                'weight' => 'nullable|numeric|min:1|max:999.99',
                'membership_type' => 'required|in:basic,premium,vip',
                'expiry_date' => 'required|date|after:today',
                'trainor_id' => 'nullable|exists:trainors,id',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            Log::info('Member creation started', [
                'request_data' => $request->all(),
                'validated_data' => $validated
            ]);

            // Generate random password
            $randomPassword = \Illuminate\Support\Str::random(12);
            
            // Create user account for the member
            $user = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($randomPassword),
                'role' => 'member'
            ]);
            
            Log::info('User account created successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // Handle profile photo upload
            $profilePhotoPath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            }

            // Create member record linked to user
            $member = Member::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'contact_number' => $validated['contact_number'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'weight' => $validated['weight'] ?? null,
                'membership_type' => $validated['membership_type'],
                'expiry_date' => $validated['expiry_date'],
                'join_date' => now(),
                'trainor_id' => $validated['trainor_id'] ?? null,
                'random_password' => $randomPassword,
                'profile_photo' => $profilePhotoPath
            ]);
            
            Log::info('Member created successfully', [
                'member_id' => $member->id,
                'user_id' => $member->user_id,
                'email' => $member->email,
                'trainor_id' => $member->trainor_id
            ]);

            // If trainor is selected, update the trainor's assigned_member_id
            if (!empty($validated['trainor_id'])) {
                $trainor = \App\Models\Trainor::find($validated['trainor_id']);
                if ($trainor) {
                    $trainor->update(['assigned_member_id' => $member->id]);
                    Log::info('Trainor assigned member updated', [
                        'trainor_id' => $trainor->id,
                        'assigned_member_id' => $member->id
                    ]);
                }
            }

            // Create sales record for the new membership
            $membershipPrices = [
                'basic' => 500,
                'premium' => 700,
                'vip' => 1000,
            ];

            $saleAmount = $membershipPrices[$validated['membership_type']];

            Sale::create([
                'type' => 'membership',
                'description' => "New membership for {$member->name} ({$validated['membership_type']})",
                'amount' => $saleAmount,
                'sale_date' => now()->toDateString(),
                'member_id' => $member->id,
                'user_id' => Auth::id(),
                'metadata' => [
                    'membership_type' => $validated['membership_type'],
                    'expiry_date' => $validated['expiry_date'],
                    'trainor_id' => $validated['trainor_id']
                ]
            ]);

            // Send credentials notification to the member
            try {
                $member->notify(new \App\Notifications\MemberCredentialsNotification($randomPassword));
                Log::info('Member credentials notification sent', [
                    'member_id' => $member->id,
                    'email' => $member->email
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send credentials notification', [
                    'member_id' => $member->id,
                    'error' => $e->getMessage()
                ]);
            }

            return redirect()->route('members.list')
                ->with('success', 'Member created successfully! Credentials email sent.');
                
        } catch (\Exception $e) {
            Log::error('Member creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating member: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('members.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,'.$id,
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date|before:today',
            'weight' => 'nullable|numeric|min:1|max:999.99',
            'membership_type' => 'required|in:basic,premium,vip',
            'trainor_id' => 'nullable|exists:trainors,id',
            'expiry_date' => 'required|date|after:today'
        ]);

        try {
            $member = Member::findOrFail($id);
            $member->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'contact_number' => $validated['contact_number'] ?? $member->contact_number,
                'address' => $validated['address'] ?? $member->address,
                'gender' => $validated['gender'] ?? $member->gender,
                'date_of_birth' => $validated['date_of_birth'] ?? $member->date_of_birth,
                'weight' => $validated['weight'] ?? $member->weight,
                'membership_type' => $validated['membership_type'],
                'trainor_id' => $validated['trainor_id'] ?? $member->trainor_id,
                'expiry_date' => $validated['expiry_date']
            ]);

            return redirect()->route('members.list')
                ->with('success', 'Member updated successfully!');

        } catch (\Exception $e) {
            return redirect()->route('members.list')
                ->with('error', 'Error updating member: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            $user = $member->user;

            // Use database transaction to ensure atomicity
            \Illuminate\Support\Facades\DB::transaction(function () use ($member, $user) {
                // Delete the member first (it has foreign key to user)
                $member->delete();

                // Then delete the associated user
                if ($user) {
                    $user->delete();
                }
            });

            return redirect()->route('members.list')
                ->with('success', 'Member and associated user deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('members.list')
                ->with('error', 'Error deleting member: ' . $e->getMessage());
        }
    }

    public function renew(Request $request, $id)
    {
        $validated = $request->validate([
            'membership_type' => 'required|in:basic,premium,vip',
            'trainor_id' => 'nullable|exists:trainors,id',
            'expiry_date' => 'required|date|after:today'
        ]);

        $member = Member::findOrFail($id);

        // Update member details
        $member->update([
            'membership_type' => $validated['membership_type'],
            'expiry_date' => $validated['expiry_date'],
            'trainor_id' => $validated['trainor_id'] ?? null,
        ]);

        // Handle trainor assignment
        if (!empty($validated['trainor_id'])) {
            $trainor = \App\Models\Trainor::find($validated['trainor_id']);
            if ($trainor) {
                $trainor->update(['assigned_member_id' => $member->id]);
                Log::info('Trainor assigned member updated during renewal', [
                    'trainor_id' => $trainor->id,
                    'assigned_member_id' => $member->id
                ]);
            }
        } else {
            // If no trainor selected, remove assignment from any previous trainor
            $previousTrainor = \App\Models\Trainor::where('assigned_member_id', $member->id)->first();
            if ($previousTrainor) {
                $previousTrainor->update(['assigned_member_id' => null]);
                Log::info('Trainor assignment removed during renewal', [
                    'trainor_id' => $previousTrainor->id,
                    'member_id' => $member->id
                ]);
            }
        }

        // Create sales record for the renewal
        $membershipPrices = [
            'basic' => 500,
            'premium' => 700,
            'vip' => 1000,
        ];

        $saleAmount = $membershipPrices[$validated['membership_type']];

        Sale::create([
            'type' => 'renewal',
            'description' => "Membership renewal for {$member->name} ({$validated['membership_type']})",
            'amount' => $saleAmount,
            'sale_date' => now()->toDateString(),
            'member_id' => $member->id,
            'user_id' => Auth::id(),
            'metadata' => [
                'membership_type' => $validated['membership_type'],
                'previous_expiry' => $member->getOriginal('expiry_date'),
                'new_expiry' => $validated['expiry_date'],
                'trainor_id' => $validated['trainor_id'],
                'is_renewal' => true
            ]
        ]);

        Log::info('Member renewed successfully', [
            'member_id' => $member->id,
            'new_membership_type' => $validated['membership_type'],
            'new_expiry_date' => $validated['expiry_date'],
            'new_trainor_id' => $validated['trainor_id'],
            'sale_amount' => $saleAmount
        ]);

        return redirect()->route('members.list')->with('success', 'Member renewed successfully!');
    }

    public function finance()
    {
        $members = \App\Models\Member::all();
        $walkInLogs = \App\Models\WalkInLog::all();
        $expenses = \App\Models\Expense::all();
        $membershipPrices = [
            'basic' => 500,
            'premium' => 700,
            'vip' => 1000,
        ];

        // Fetch all sales including renewals
        $sales = \App\Models\Sale::all();

        // Calculate total sales amount
        $totalSalesAmount = $sales->sum('amount');

        return view('admin.finance', [
            'members' => $members,
            'walkInLogs' => $walkInLogs,
            'expenses' => $expenses,
            'membershipPrices' => $membershipPrices,
            'totalSalesAmount' => $totalSalesAmount,
            'sales' => $sales,
        ]);
    }

    public function notifyMember($id)
    {
        try {
            $member = Member::findOrFail($id);
            \Log::info('Sending notification to member: ' . $member->email);
            $member->notify(new \App\Notifications\MembershipExpiryNotification($member));
            \Log::info('Notification sent successfully to: ' . $member->email);
            return redirect()->route('members.list')->with('success', 'Notification email sent successfully to ' . $member->name);
        } catch (\Exception $e) {
            \Log::error('Failed to send notification to member ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('members.list')->with('error', 'Failed to send notification: ' . $e->getMessage());
        }
    }

    public function profile()
    {
        $member = Auth::user()->member;

        if (!$member) {
            abort(404, 'Member profile not found.');
        }

        // Calculate additional data for enhanced profile
        $now = now();
        $isActive = $member->expiry_date > $now;
        $daysRemaining = $isActive ? (int) $now->diffInDays($member->expiry_date) : 0;

        // Attendance statistics
        $attendances = \App\Models\Attendance::where('member_id', $member->id)->get();
        $totalAttendances = $attendances->count();
        $presentCount = $attendances->where('status', 'present')->count();
        $attendanceRate = $totalAttendances > 0 ? round(($presentCount / $totalAttendances) * 100, 1) : 0;

        // Workout sessions this month
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $workoutSessionsThisMonth = $attendances->where('status', 'present')
            ->where('date', '>=', $now->startOfMonth())
            ->where('date', '<=', $now->endOfMonth())
            ->count();

        // Age calculation
        $age = $member->date_of_birth ? $member->date_of_birth->age : null;

        // Recent activities (last 5 attendances)
        $recentActivities = $attendances->sortByDesc('date')->take(5);

        // Membership progress percentage
        $totalMembershipDays = $member->join_date->diffInDays($member->expiry_date);
        $elapsedDays = $member->join_date->diffInDays($now);
        $progressPercentage = $totalMembershipDays > 0 ? min(100, round(($elapsedDays / $totalMembershipDays) * 100)) : 0;

        return view('member.profile', compact(
            'member',
            'daysRemaining',
            'attendanceRate',
            'workoutSessionsThisMonth',
            'age',
            'recentActivities',
            'progressPercentage',
            'totalAttendances',
            'presentCount'
        ));
    }

    public function updateProfile(\App\Http\Requests\MemberProfileUpdateRequest $request)
    {
        $member = Auth::user()->member;

        if (!$member) {
            abort(404, 'Member profile not found.');
        }

        $validated = $request->validated();

        // Handle profile photo upload
        $updateData = [
            'contact_number' => $validated['contact_number'] ?? $member->contact_number,
            'address' => $validated['address'] ?? $member->address,
            'gender' => $validated['gender'] ?? $member->gender,
            'date_of_birth' => $validated['date_of_birth'] ?? $member->date_of_birth,
            'weight' => $validated['weight'] ?? $member->weight,
        ];

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $updateData['profile_photo'] = $profilePhotoPath;
        }

        $member->update($updateData);

        return redirect()->route('member.profile')->with('success', 'Profile updated successfully!');
    }

    public function workoutPlans()
    {
        // Show workout plans created by trainors, available to all members
        $workoutPlans = \App\Models\WorkoutPlan::with('trainor')
            ->orderBy('created_at', 'desc')
            ->get();

        $member = Auth::user()->member;
        $memberTrainor = $member ? $member->trainor : null;

        return view('member.workout_plans.index', compact('workoutPlans', 'memberTrainor'));
    }

    public function showWorkoutPlan($id)
    {
        $workoutPlan = \App\Models\WorkoutPlan::with('trainor', 'exercises')->findOrFail($id);

        // Calculate real weekly schedule based on exercises' days
        $weeklySchedule = [
            'Monday' => false,
            'Tuesday' => false,
            'Wednesday' => false,
            'Thursday' => false,
            'Friday' => false,
            'Saturday' => false,
            'Sunday' => false,
        ];

        foreach ($workoutPlan->exercises as $exercise) {
            $day = ucfirst(strtolower($exercise->day));
            if (array_key_exists($day, $weeklySchedule)) {
                $weeklySchedule[$day] = true;
            }
        }

        return view('member.workout_plans.show', compact('workoutPlan', 'weeklySchedule'));
    }

    public function attendance()
    {
        $member = Auth::user()->member;

        if (!$member) {
            abort(404, 'Member profile not found.');
        }

        // Get attendance records for the member
        $attendances = \App\Models\Attendance::where('member_id', $member->id)
            ->with('trainor')
            ->orderBy('date', 'desc')
            ->get();

        // Prepare calendar events for FullCalendar
        $calendarEvents = $attendances->map(function ($attendance) use ($member) {
            $color = match($attendance->status) {
                'present' => '#10b981', // green
                'late' => '#f59e0b',    // yellow
                'absent' => '#ef4444',  // red
                default => '#6b7280'    // gray
            };

            return [
                'title' => ucfirst($attendance->status),
                'start' => $attendance->date->format('Y-m-d'),
                'backgroundColor' => $color,
                'borderColor' => $color,
                'extendedProps' => [
                    'member' => $member->name,
                    'date' => $attendance->date->format('M j, Y'),
                    'status' => $attendance->status,
                    'time' => $attendance->time,
                    'trainor' => $attendance->trainor ? $attendance->trainor->name : 'N/A'
                ]
            ];
        });

        // Calculate attendance statistics
        $totalRecords = $attendances->count();
        $presentCount = $attendances->where('status', 'present')->count();
        $lateCount = $attendances->where('status', 'late')->count();
        $absentCount = $attendances->where('status', 'absent')->count();

        $attendanceRate = $totalRecords > 0 ? round(($presentCount / $totalRecords) * 100, 1) : 0;

        return view('member.attendance', compact(
            'attendances',
            'calendarEvents',
            'totalRecords',
            'presentCount',
            'lateCount',
            'absentCount',
            'attendanceRate'
        ));
    }

    public function products()
    {
        $member = Auth::user()->member;

        if (!$member) {
            abort(404, 'Member profile not found.');
        }

        // Get all available products
        $products = \App\Models\Product::where('quantity', '>', 0)
            ->orderBy('product_name', 'asc')
            ->get();

        // Get recent orders for the member
        $recentOrders = \App\Models\Order::where('member_id', $member->id)
            ->with('product')
            ->orderBy('order_date', 'desc')
            ->take(5)
            ->get();

        return view('member.products', compact('products', 'recentOrders'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $member = Auth::user()->member;

        if (!$member) {
            return redirect()->route('member.products')->with('error', 'Member profile not found.');
        }

        $product = \App\Models\Product::findOrFail($request->product_id);

        // Check if product is in stock
        if ($product->quantity < $request->quantity) {
            return redirect()->route('member.products')->with('error', 'Insufficient stock for this product.');
        }

        // Calculate total amount
        $totalAmount = $product->selling_price * $request->quantity;

        try {
            // Create the order
            \App\Models\Order::create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'total_amount' => $totalAmount,
                'member_id' => $member->id,
                'order_date' => now()->toDateString(),
                'status' => 'pending', // Default status
            ]);

            // Update product quantity
            $product->decrement('quantity', $request->quantity);

            return redirect()->route('member.products')->with('success', 'Order placed successfully! Your order is being processed.');

        } catch (\Exception $e) {
            \Log::error('Order creation failed', [
                'member_id' => $member->id,
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('member.products')->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function memberPortal()
    {
        $member = Auth::user()->member;

        if (!$member) {
            abort(404, 'Member profile not found.');
        }

        // Membership status and days remaining
        $now = now();
        $isActive = $member->expiry_date > $now;
        $daysRemaining = $isActive ? (int) $now->diffInDays($member->expiry_date) : 0;

        // Workout sessions this month
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $workoutSessionsThisMonth = \App\Models\Attendance::where('member_id', $member->id)
            ->where('status', 'present')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        // Goal progress (using attendance rate as proxy)
        $totalAttendances = \App\Models\Attendance::where('member_id', $member->id)->count();
        $presentAttendances = \App\Models\Attendance::where('member_id', $member->id)
            ->where('status', 'present')
            ->count();
        $goalProgress = $totalAttendances > 0 ? round(($presentAttendances / $totalAttendances) * 100) : 0;

        // Workout plans
        $workoutPlans = \App\Models\WorkoutPlan::with('trainor')
            ->orderBy('created_at', 'desc')
            ->take(2) // Limit to 2 for display
            ->get();

        // Recent activity (last 3 attendances)
        $recentActivities = \App\Models\Attendance::where('member_id', $member->id)
            ->with('trainor')
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        // Recent orders (last 5 orders)
        $recentOrders = \App\Models\Order::where('member_id', $member->id)
            ->with('product')
            ->orderBy('order_date', 'desc')
            ->take(5)
            ->get();

        // Get trainor user for messaging
        $trainorUser = $member->trainor ? $member->trainor->user : null;

        return view('member-portal', compact(
            'member',
            'isActive',
            'daysRemaining',
            'workoutSessionsThisMonth',
            'goalProgress',
            'workoutPlans',
            'recentActivities',
            'recentOrders',
            'trainorUser'
        ));
    }

    public function adminAttendance()
    {
        // Get all attendance records with member and trainor relationships
        $attendances = \App\Models\Attendance::with(['member', 'trainor'])
            ->orderBy('date', 'desc')
            ->paginate(20);

        // Calculate overall statistics
        $totalRecords = \App\Models\Attendance::count();
        $presentCount = \App\Models\Attendance::where('status', 'present')->count();
        $absentCount = \App\Models\Attendance::where('status', 'absent')->count();
        $lateCount = \App\Models\Attendance::where('status', 'late')->count();

        $attendanceRate = $totalRecords > 0 ? round(($presentCount / $totalRecords) * 100, 1) : 0;

        // Get members and trainors for the form
        $members = \App\Models\Member::with('trainor')->orderBy('name')->get();
        $trainors = \App\Models\Trainor::orderBy('name')->get();

        return view('admin.attendance', compact(
            'attendances',
            'totalRecords',
            'presentCount',
            'absentCount',
            'lateCount',
            'attendanceRate',
            'members',
            'trainors'
        ));
    }

    /**
     * Show the form for managing attendance.
     */
    public function manageAttendance()
    {
        $members = \App\Models\Member::orderBy('name')->get();
        $trainors = \App\Models\Trainor::orderBy('name')->get();

        return view('admin.manage-attendance', compact('members', 'trainors'));
    }

    /**
     * Store or update attendance record.
     */
    public function storeAttendance(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance = \App\Models\Attendance::updateOrCreate(
            [
                'member_id' => $validated['member_id'],
                'date' => $validated['date'],
            ],
            [
                'status' => $validated['status'],
                'time' => now()->format('H:i'),
            ]
        );

        return redirect()->route('admin.attendance')->with('success', 'Attendance record saved successfully.');
    }

    public function destroyAttendance($id)
    {
        try {
            $attendance = \App\Models\Attendance::findOrFail($id);
            $attendance->delete();

            return redirect()->route('admin.attendance')->with('success', 'Attendance record deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.attendance')->with('error', 'Failed to delete attendance record: ' . $e->getMessage());
        }
    }
}
