<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    public function create(int $trainingId)
    {
        $training = Training::findOrFail($trainingId);

        return view('admin.sessions.create', compact('training'));
    }

    public function store(Request $request, int $trainingId): RedirectResponse
    {
        $training = Training::findOrFail($trainingId);

        $validated = $request->validate([
            'session_name' => ['required', 'string', 'max:150'],
            'day_name' => ['nullable', 'string', 'max:30'],
            'session_date' => ['required', 'date'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'quota' => ['required', 'integer', 'min:1'],
            'quiz_open_at' => ['nullable', 'date'],
            'quiz_close_at' => ['nullable', 'date'],
            'material_link' => ['nullable', 'url'],
            'diklat_link' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['training_id'] = $training->id;
        $validated['is_active'] = $request->boolean('is_active');

        TrainingSession::create($validated);

        return redirect()->route('admin.trainings.index')
            ->with('success', 'Sesi training berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $session = TrainingSession::with('training')->findOrFail($id);

        return view('admin.sessions.edit', compact('session'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $session = TrainingSession::findOrFail($id);

        $validated = $request->validate([
            'session_name' => ['required', 'string', 'max:150'],
            'day_name' => ['nullable', 'string', 'max:30'],
            'session_date' => ['required', 'date'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'quota' => ['required', 'integer', 'min:1'],
            'quiz_open_at' => ['nullable', 'date'],
            'quiz_close_at' => ['nullable', 'date'],
            'material_link' => ['nullable', 'url'],
            'diklat_link' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $session->update($validated);

        return redirect()->route('admin.trainings.index')
            ->with('success', 'Sesi training berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $session = TrainingSession::findOrFail($id);
        $session->delete();

        return back()->with('success', 'Sesi training berhasil dihapus.');
    }

    public function toggle(int $id): RedirectResponse
    {
        $session = TrainingSession::findOrFail($id);

        $session->update([
            'is_active' => ! $session->is_active,
        ]);

        return back()->with('success', 'Status sesi berhasil diubah.');
    }
}