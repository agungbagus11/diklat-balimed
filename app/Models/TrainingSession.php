<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $fillable = [
        'training_id',
        'session_name',
        'day_name',
        'session_date',
        'start_time',
        'end_time',
        'quota',
        'is_active',
        'quiz_open_at',
        'quiz_close_at',
        'material_link',
        'diklat_link',
    ];

    protected $casts = [
        'session_date' => 'date',
        'quiz_open_at' => 'datetime',
        'quiz_close_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'training_session_id');
    }

    public function approvedCount(): int
    {
        return $this->registrations()->where('status', 'approved')->count();
    }

    public function remainingQuota(): int
    {
        return max(0, $this->quota - $this->approvedCount());
    }
}