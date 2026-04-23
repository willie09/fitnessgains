<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainor;
use App\Models\User;
use App\Notifications\TrainorCredentialsNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\Attendance;

class TrainorController extends Controller
{
    /**
     * Display a listing of the trainors.
     */
    public function index()
    {
        $trainors = Trainor::with('user')->withCount('members')->get();
        return view('admin.trainors', compact('trainors'));
    }


    /**
     * Show the form for creating a new trainor.
     */
    public function create()
    {
        return view('admin.trainors.create');
    }

    /**
     * Store a newly created trainor in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:trainors|unique:users',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'profile_photo' => ['nullable', 'image', 'max:10048'],
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date|before:today',
            'age' => 'nullable|integer|min:0',
            'address' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        
        try {
            // Generate random password
            $password = Str::random(12);
            
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($password),
                'role' => 'trainor',
            ]);

            // Handle profile photo upload
            $profileImagePath = null;
            if ($request->hasFile('profile_photo')) {
                $profileImagePath = $request->file('profile_photo')->store('trainor-profiles', 'public');
            }

            // Create trainor record
            $trainor = Trainor::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'specialization' => $validated['specialization'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'years_of_experience' => $validated['years_of_experience'] ?? 0,
                'is_active' => $validated['is_active'] ?? true,
                'random_password' => $password,
                'profile_image' => $profileImagePath,
                'gender' => $validated['gender'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'age' => $validated['age'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            // Send credentials via email
            $user->notify(new TrainorCredentialsNotification($password));

            DB::commit();

            return redirect()->route('trainors')->with('success', 'Trainor created successfully! User account has been generated with email: ' . $user->email . ' and password: ' . $password);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Failed to create trainor: ' . $e->getMessage());
        }
    }

    /**
     * Get members mentored by the specified trainor.
     */
    public function getMembers($id)
    {
        $trainor = Trainor::with('members')->findOrFail($id);
        return response()->json($trainor->members);
    }

    public function show(string $id)
    {
        $trainor = Trainor::findOrFail($id);
        return view('admin.trainors.show', compact('trainor'));
    }

    /**
     * Show the form for editing the specified trainor.
     */
    public function edit(string $id)
    {
        $trainor = Trainor::findOrFail($id);
        return view('admin.trainors.edit', compact('trainor'));
    }

    /**
     * Update the specified trainor in storage.
     */
    public function update(Request $request, string $id)
    {
        $trainor = Trainor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:trainors,email,' . $trainor->id,
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date|before:today',
            'age' => 'nullable|integer|min:0',
            'address' => 'nullable|string|max:500',
        ]);

        $trainor->update($validated);

        return redirect()->route('trainors')->with('success', 'Trainor updated successfully.');
    }

    /**
     * Remove the specified trainor from storage.
     */
    public function destroy(string $id)
    {
        $trainor = Trainor::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Delete associated user account
            if ($trainor->user) {
                $trainor->user->delete();
            }
            
            // Delete trainor record
            $trainor->delete();
            
            DB::commit();
            
            return redirect()->route('trainors')->with('success', 'Trainor and associated user account deleted successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete trainor: ' . $e->getMessage());
        }
    }

    /**
     * Assign trainor to member
     */
    public function assign(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainor_id' => 'required|exists:users,id',
        ]);

        // Logic to assign trainor to member
        // This would depend on your database structure
        
        return redirect()->back()->with('success', 'Trainor assigned successfully.');
    }

    /**
     * Get trainor schedule
     */
    public function schedule(string $id)
    {
        $trainor = User::where('role', 'trainor')->findOrFail($id);

        // Logic to get trainor schedule
        return view('admin.trainors.schedule', compact('trainor'));
    }

    /**
     * Display attendance records for the authenticated trainor.
     */
    public function attendanceIndex()
    {
        $trainor = auth()->user()->trainor;

        if (!$trainor) {
            return redirect()->route('trainor.dashboard')->with('error', 'Trainor profile not found. Please contact administrator.');
        }

        $members = $trainor->members;
        $attendances = Attendance::where('trainor_id', $trainor->id)
            ->with('member')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('member_id');

        return view('trainor.attendance', compact('members', 'attendances'));
    }

    /**
     * Mark attendance for members.
     */
    public function markAttendance(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $trainor = auth()->user()->trainor;

        if (!$trainor) {
            return redirect()->route('trainor.attendance')->with('error', 'Trainor profile not found. Please contact administrator.');
        }

        // Check if member is assigned to this trainor
        if (!$trainor->members()->where('id', $validated['member_id'])->exists()) {
            return redirect()->back()->with('error', 'You can only mark attendance for your assigned members.');
        }

        // Check if attendance already exists for this date and member
        $existing = Attendance::where('member_id', $validated['member_id'])
            ->where('date', $validated['date'])
            ->first();

        $currentTime = now()->format('H:i');

        if ($existing) {
            $existing->update([
                'status' => $validated['status'],
                'time' => $currentTime,
            ]);
            $message = 'Attendance updated successfully.';
        } else {
            Attendance::create([
                'member_id' => $validated['member_id'],
                'trainor_id' => $trainor->id,
                'date' => $validated['date'],
                'status' => $validated['status'],
                'time' => $currentTime,
            ]);
            $message = 'Attendance marked successfully.';
        }

        return redirect()->back()->with('success', $message);
    }
}
