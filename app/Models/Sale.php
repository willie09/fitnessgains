<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'type',
        'description',
        'amount',
        'sale_date',
        'member_id',
        'user_id',
        'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'sale_date' => 'date',
        'metadata' => 'array'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
