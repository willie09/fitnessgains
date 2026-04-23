<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_plan_id',
        'name',
        'sets',
        'reps_or_time',
        'rest_time',
        'day',
        'instructions',
    ];

    /**
     * Get the workout plan that owns the exercise.
     */
    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
}
