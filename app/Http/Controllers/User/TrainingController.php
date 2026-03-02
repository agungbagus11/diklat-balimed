<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with(['category', 'sessions'])
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('user.trainings.index', compact('trainings'));
    }
}