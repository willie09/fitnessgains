<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Models\Member;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    /**
     * Display a listing of the workout plans for the authenticated trainor.
     */
    public function index()
    {
        $trainor = Auth::user()->trainor;
        $userWorkoutPlans = WorkoutPlan::where('trainor_id', $trainor->id)->with('exercises')->get();
        $otherWorkoutPlans = WorkoutPlan::where('trainor_id', '!=', $trainor->id)->whereNotNull('trainor_id')->with('trainor.user', 'exercises')->get();
        $workoutPlans = $userWorkoutPlans->merge($otherWorkoutPlans);
        $members = $trainor->members;
        return view('trainor.workout_plans.index', compact('userWorkoutPlans', 'otherWorkoutPlans', 'workoutPlans', 'members'));
    }

    /**
     * Display the specified workout plan.
     */
    public function show($id)
    {
        $workoutPlan = WorkoutPlan::with('exercises')->findOrFail($id);
        $exercises = $workoutPlan->exercises;
        return view('trainor.workout_plans.show', compact('workoutPlan', 'exercises'));
    }

    /**
     * Show the form for creating a new workout plan.
     */
    public function create()
    {
        return view('trainor.workout_plans.create');
    }

    /**
     * Store a newly created workout plan in storage.
     */
    public function store(Request $request)
    {
        $trainor = Auth::user()->trainor;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_goal' => 'required|string|max:255',
        ]);

        $validated['trainor_id'] = $trainor->id;

        WorkoutPlan::create($validated);

        return redirect()->route('workout_plans.index')->with('success', 'Workout plan created successfully.');
    }

    /**
     * Show the form for editing the specified workout plan.
     */
    public function edit($id)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($id);
        return view('trainor.workout_plans.edit', compact('workoutPlan'));
    }

    /**
     * Update the specified workout plan in storage.
     */
    public function update(Request $request, $id)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_goal' => 'required|string|max:255',
        ]);

        $workoutPlan->update($validated);

        return redirect()->route('workout_plans.index')->with('success', 'Workout plan updated successfully.');
    }

    /**
     * Remove the specified workout plan from storage.
     */
    public function destroy($id)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($id);
        $workoutPlan->delete();

        return redirect()->route('workout_plans.index')->with('success', 'Workout plan deleted successfully.');
    }

    /**
     * Display exercises for a specific workout plan.
     */
    public function exercises($id)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($id);
        $exercises = $workoutPlan->exercises()->get();

        return response()->json($exercises);
    }

    /**
     * Store a newly created exercise for a workout plan.
     */
    public function addExercise(Request $request, $workoutPlanId)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($workoutPlanId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sets' => 'nullable|integer',
            'reps_or_time' => 'nullable|string|max:255',
            'rest_time' => 'nullable|string|max:255',
            'day' => 'nullable|string|max:255',
            'instructions' => 'nullable|string',
        ]);

        $validated['workout_plan_id'] = $workoutPlan->id;

        Exercise::create($validated);

        return redirect()->route('workout_plans.show', $workoutPlan->id)->with('success', 'Exercise added successfully.');
    }

    /**
     * Remove the specified exercise from a workout plan.
     */
    public function deleteExercise($workoutPlanId, $exerciseId)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($workoutPlanId);
        $exercise = Exercise::where('workout_plan_id', $workoutPlan->id)->findOrFail($exerciseId);
        $exercise->delete();

        return redirect()->route('workout_plans.show', $workoutPlan->id)->with('success', 'Exercise deleted successfully.');
    }

    /**
     * Suggest the workout plan to a member.
     */
    public function suggestToMember(Request $request, $id)
    {
        $trainor = Auth::user()->trainor;
        $workoutPlan = WorkoutPlan::where('trainor_id', $trainor->id)->findOrFail($id);

        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);

        $member = Member::where('id', $validated['member_id'])->where('trainor_id', $trainor->id)->firstOrFail();

        // For now, just flash a success message
        return redirect()->route('workout_plans.index')->with('success', 'Workout plan suggested to ' . $member->name . ' successfully.');
    }
}
