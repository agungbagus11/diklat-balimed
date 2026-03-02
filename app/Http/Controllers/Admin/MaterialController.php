<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(int $trainingId)
    {
        $training = Training::with('materials')->findOrFail($trainingId);

        return view('admin.materials.index', compact('training'));
    }

    public function create(int $trainingId)
    {
        $training = Training::findOrFail($trainingId);

        return view('admin.materials.create', compact('training'));
    }

    public function store(Request $request, int $trainingId): RedirectResponse
    {
        $training = Training::findOrFail($trainingId);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'type' => ['required', 'in:google_drive,youtube,url'],
            'url' => ['required', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['training_id'] = $training->id;
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->boolean('is_active');

        Material::create($validated);

        return redirect()->route('admin.materials.index', $training->id)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $material = Material::with('training')->findOrFail($id);

        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $material = Material::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'type' => ['required', 'in:google_drive,youtube,url'],
            'url' => ['required', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->boolean('is_active');

        $material->update($validated);

        return redirect()->route('admin.materials.index', $material->training_id)
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $material = Material::findOrFail($id);
        $trainingId = $material->training_id;
        $material->delete();

        return redirect()->route('admin.materials.index', $trainingId)
            ->with('success', 'Materi berhasil dihapus.');
    }

    public function toggle(int $id): RedirectResponse
    {
        $material = Material::findOrFail($id);
        $trainingId = $material->training_id;

        $material->update([
            'is_active' => ! $material->is_active,
        ]);

        return redirect()->route('admin.materials.index', $trainingId)
            ->with('success', 'Status materi berhasil diubah.');
    }
}