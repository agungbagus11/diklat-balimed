<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Training;

class MaterialController extends Controller
{
    public function index()
    {
        $trainings = Training::with(['category', 'materials'])
            ->where('is_active', 1)
            ->whereHas('materials', function ($q) {
                $q->where('is_active', 1);
            })
            ->latest()
            ->get();

        return view('user.materials.index', compact('trainings'));
    }
}