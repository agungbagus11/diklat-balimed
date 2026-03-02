<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'training_category_id',
        'code',
        'title',
        'description',
        'organizer',
        'location',
        'method',
        'is_active',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }

    public function sessions()
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    public function materials()
    {
        return $this->hasMany(\App\Models\Material::class)->orderBy('sort_order')->orderBy('id');
    }
}