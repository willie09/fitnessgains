<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalkInLog extends Model
{
    use HasFactory;

    protected $table = 'walk_in_logs';

    protected $fillable = [
        'name',
        'time',
        'date',
        'amount',
    ];

    protected $casts = [
        'time' => 'datetime:H:i:s',
        'date' => 'date',
        'amount' => 'decimal:2',
    ];
}
