<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Member extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'contact_number',
        'address',
        'gender',
        'date_of_birth',
        'weight',
        'membership_type',
        'join_date',
        'expiry_date',
        'random_password',
        'trainor_id',
        'profile_photo'
    ];

    protected $casts = [
        'join_date' => 'date',
        'expiry_date' => 'date',
        'date_of_birth' => 'date',
        'weight' => 'decimal:2',
    ];

    /**
     * Get the age of the member based on date of birth.
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    /**
     * Get the user associated with the member.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trainor associated with the member.
     */
    public function trainor()
    {
        return $this->belongsTo(Trainor::class);
    }

    /**
     * Get all attendance records for the member.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get all messages sent by the member.
     */
    public function sentMessages()
    {
        return $this->hasManyThrough(Message::class, User::class, 'id', 'sender_id', 'user_id', 'id');
    }

    /**
     * Get all messages received by the member.
     */
    public function receivedMessages()
    {
        return $this->hasManyThrough(Message::class, User::class, 'id', 'receiver_id', 'user_id', 'id');
    }
}
