<?php

namespace App\Http\Controllers;

use App\Models\ProgressEntry;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\JsonResponse;

class TrainorProgressController extends Controller
{
    public function index()
    {
        $trainor = Auth::user()->trainor;
        $members = $trainor->members;

        return view('trainor.progress.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'bmi' => 'nullable|numeric|min:0',
            'workout_performance' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $trainor = Auth::user()->trainor;

        // Verify the member belongs to this trainor
        $member = $trainor->members()->find($request->member_id);
        if (!$member) {
            return back()->withErrors(['member_id' => 'You can only add progress for your assigned members.']);
        }

        ProgressEntry::create($request->all());

        return back()->with('success', 'Progress entry added successfully.');
    }

    public function update(Request $request, ProgressEntry $progressEntry)
    {
        $request->validate([
            'date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'bmi' => 'nullable|numeric|min:0',
            'workout_performance' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $trainor = Auth::user()->trainor;

        // Verify the progress entry belongs to this trainor's member
        if (!$trainor->members()->where('members.id', $progressEntry->member_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $progressEntry->update($request->all());

        return back()->with('success', 'Progress entry updated successfully.');
    }

    public function destroy(ProgressEntry $progressEntry)
    {
        $trainor = Auth::user()->trainor;

        // Verify the progress entry belongs to this trainor's member
        if (!$trainor->members()->where('members.id', $progressEntry->member_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $progressEntry->delete();

        return back()->with('success', 'Progress entry deleted successfully.');
    }

    /**
     * Return progress history for a member as JSON for charting.
     */
    public function memberHistory($memberId): JsonResponse
    {
        $trainor = Auth::user()->trainor;

        // Verify the member belongs to this trainor
        $member = $trainor->members()->find($memberId);
        if (!$member) {
            return response()->json(['error' => 'Unauthorized or member not found'], 403);
        }

        $progressEntries = ProgressEntry::where('member_id', $memberId)
            ->orderBy('date', 'asc')
            ->get(['id', 'date', 'weight', 'body_fat_percentage', 'bmi', 'workout_performance', 'notes']);

        return response()->json($progressEntries);
    }

    /**
     * Return a single progress entry as JSON for editing.
     */
    public function show(ProgressEntry $progressEntry): JsonResponse
    {
        $trainor = Auth::user()->trainor;

        // Verify the progress entry belongs to this trainor's member
        if (!$trainor->members()->where('members.id', $progressEntry->member_id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($progressEntry);
    }
}
