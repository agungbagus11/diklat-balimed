<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with(['category', 'sessions'])
            ->latest()
            ->get();

        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        $categories = TrainingCategory::where('is_active', 1)->orderBy('name')->get();

        return view('admin.trainings.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'training_category_id' => ['required', 'exists:training_categories,id'],
            'code' => ['required', 'string', 'max:50', 'unique:trainings,code'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'organizer' => ['nullable', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:150'],
            'method' => ['required', 'in:offline,online,hybrid'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['created_by'] = auth()->id();

        Training::create($validated);

        return redirect()->route('admin.trainings.index')
            ->with('success', 'Training berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $training = Training::findOrFail($id);
        $categories = TrainingCategory::where('is_active', 1)->orderBy('name')->get();

        return view('admin.trainings.edit', compact('training', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $training = Training::findOrFail($id);

        $validated = $request->validate([
            'training_category_id' => ['required', 'exists:training_categories,id'],
            'code' => ['required', 'string', 'max:50', 'unique:trainings,code,' . $training->id],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'organizer' => ['nullable', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:150'],
            'method' => ['required', 'in:offline,online,hybrid'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $training->update($validated);

        return redirect()->route('admin.trainings.index')
            ->with('success', 'Training berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $training = Training::findOrFail($id);
        $training->delete();

        return back()->with('success', 'Training berhasil dihapus.');
    }

    public function toggle(int $id): RedirectResponse
    {
        $training = Training::findOrFail($id);

        $training->update([
            'is_active' => ! $training->is_active,
        ]);

        return back()->with('success', 'Status training berhasil diubah.');
    }
}