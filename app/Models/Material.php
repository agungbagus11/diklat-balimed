<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'training_id',
        'title',
        'type',
        'url',
        'description',
        'sort_order',
        'is_active',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}