<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainor_id',
        'title',
        'description',
        'category_goal',
    ];

    /**
     * Get the trainor associated with the workout plan.
     */
    public function trainor()
    {
        return $this->belongsTo(Trainor::class);
    }

    /**
     * Get the exercises for the workout plan.
     */
    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
