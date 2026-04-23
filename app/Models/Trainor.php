<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'assigned_member_id',
        'name',
        'email',
        'phone',
        'specialization',
        'bio',
        'certification',
        'years_of_experience',
        'hourly_rate',
        'is_active',
        'profile_image',
        'random_password',
        'gender',
        'date_of_birth',
        'age',
        'address',
    ];

    /**
     * Get the user associated with the trainor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the assigned member for the trainor.
     */
    public function assignedMember()
    {
        return $this->belongsTo(Member::class, 'assigned_member_id');
    }

    /**
     * Get all members mentored by the trainor.
     */
    public function members()
    {
        return $this->hasMany(Member::class, 'trainor_id');
    }

    /**
     * Get all attendance records for the trainor.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get all messages sent by the trainor.
     */
    public function sentMessages()
    {
        return $this->hasManyThrough(Message::class, User::class, 'id', 'sender_id', 'user_id', 'id');
    }

    /**
     * Get all messages received by the trainor.
     */
    public function receivedMessages()
    {
        return $this->hasManyThrough(Message::class, User::class, 'id', 'receiver_id', 'user_id', 'id');
    }
}

