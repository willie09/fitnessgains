<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainor;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class TrainorDashboardController extends Controller
{
    /**
     * Display the trainor dashboard.
     */
    public function index()
    {
        $trainor = Trainor::where('user_id', Auth::id())->firstOrFail();
        
        // Get assigned members
        $assignedMembers = Member::where('trainor_id', $trainor->id)->get();
        

        return view('trainor.dashboard', compact('trainor', 'assignedMembers'));
    }

    /**
     * Display the trainor profile.
     */
    public function profile()
    {
        $trainor = Trainor::where('user_id', Auth::id())->firstOrFail();
        return view('trainor.profile', compact('trainor'));
    }

    /**
     * Update trainor profile.
     */
    public function updateProfile(Request $request)
    {
        $trainor = Trainor::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer|min:0',
            'certification' => 'nullable|string|max:255',
            'hourly_rate' => 'nullable|numeric|min:0',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $validated['profile_image'] = $path;
        }

        $trainor->update($validated);

        return redirect()->route('trainor.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Display assigned members.
     */
    public function members()
    {
        $trainor = Trainor::where('user_id', Auth::id())->firstOrFail();
        $members = Member::where('trainor_id', $trainor->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('trainor.members', compact('trainor', 'members'));
    }

    /**
     * Display trainor schedule.
     */
    public function schedule()
    {
        $trainor = Trainor::where('user_id', Auth::id())->firstOrFail();

        return view('trainor.schedule', compact('trainor'));
    }

    /**
     * Get schedule events for calendar.
     */
    public function getScheduleEvents()
    {
        $trainor = Trainor::where('user_id', Auth::id())->firstOrFail();

        // For now, return empty events. You can add logic to fetch actual events from attendances or sessions.
        $events = [];

        return response()->json($events);
    }

    /**
     * Display walk-in logs.
     */

}
