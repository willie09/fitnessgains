<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Models\Trainor;
use App\Models\Exercise;
use Illuminate\Http\Request;

class AdminWorkoutPlanController extends Controller
{
    /**
     * Display a listing of all workout plans.
     */
    public function index()
    {
        $workoutPlans = WorkoutPlan::with('trainor', 'exercises')->get();
        $trainors = Trainor::all();
        return view('admin.workout_plans.index', compact('workoutPlans', 'trainors'));
    }

    /**
     * Display the specified workout plan.
     */
    public function show($id)
    {
        $workoutPlan = WorkoutPlan::with('trainor', 'exercises')->findOrFail($id);
        return view('admin.workout_plans.show', compact('workoutPlan'));
    }

    /**
     * Show the form for creating a new workout plan.
     */
    public function create()
    {
        $trainors = Trainor::all();
        return view('admin.workout_plans.create', compact('trainors'));
    }

    /**
     * Store a newly created workout plan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainor_id' => 'required|exists:trainors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_goal' => 'required|string|max:255',
        ]);

        WorkoutPlan::create($validated);

        return redirect()->route('admin.workout_plans.index')->with('success', 'Workout plan created successfully.');
    }

    /**
     * Show the form for editing the specified workout plan.
     */
    public function edit($id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);
        $trainors = Trainor::all();
        return view('admin.workout_plans.edit', compact('workoutPlan', 'trainors'));
    }

    /**
     * Update the specified workout plan in storage.
     */
    public function update(Request $request, $id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);

        $validated = $request->validate([
            'trainor_id' => 'required|exists:trainors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_goal' => 'required|string|max:255',
        ]);

        $workoutPlan->update($validated);

        return redirect()->route('admin.workout_plans.index')->with('success', 'Workout plan updated successfully.');
    }

    /**
     * Remove the specified workout plan from storage.
     */
    public function destroy($id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);
        $workoutPlan->delete();

        return redirect()->route('admin.workout_plans.index')->with('success', 'Workout plan deleted successfully.');
    }

    /**
     * Display exercises for a specific workout plan.
     */
    public function exercises($id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);
        $exercises = $workoutPlan->exercises()->get();

        return response()->json($exercises);
    }

    /**
     * Store a newly created exercise for a workout plan.
     */
    public function addExercise(Request $request, $workoutPlanId)
    {
        $workoutPlan = WorkoutPlan::findOrFail($workoutPlanId);

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

        return redirect()->route('admin.workout_plans.show', $workoutPlan->id)->with('success', 'Exercise added successfully.');
    }

    /**
     * Remove the specified exercise from a workout plan.
     */
    public function deleteExercise($workoutPlanId, $exerciseId)
    {
        $workoutPlan = WorkoutPlan::findOrFail($workoutPlanId);
        $exercise = Exercise::where('workout_plan_id', $workoutPlan->id)->findOrFail($exerciseId);
        $exercise->delete();

        return redirect()->route('admin.workout_plans.show', $workoutPlan->id)->with('success', 'Exercise deleted successfully.');
    }
}
