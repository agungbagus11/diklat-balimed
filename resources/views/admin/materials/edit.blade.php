<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow border border-slate-200 p-6">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">Edit Materi</h1>
        <p class="text-slate-500 mb-6">{{ $material->training->title ?? '-' }}</p>

        <form method="POST" action="{{ route('admin.materials.update', $material->id) }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Materi</label>
                <input type="text" name="title" value="{{ $material->title }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tipe</label>
                    <select name="type" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                        <option value="google_drive" {{ $material->type === 'google_drive' ? 'selected' : '' }}>Google Drive</option>
                        <option value="youtube" {{ $material->type === 'youtube' ? 'selected' : '' }}>YouTube</option>
                        <option value="url" {{ $material->type === 'url' ? 'selected' : '' }}>URL Lain</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Urutan</label>
                    <input type="number" name="sort_order" value="{{ $material->sort_order }}" min="0" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Link Materi</label>
                <input type="url" name="url" value="{{ $material->url }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-300 px-4 py-3">{{ $material->description }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" {{ $material->is_active ? 'checked' : '' }} class="rounded border-slate-300">
                <label class="text-sm font-semibold text-slate-700">Aktifkan materi</label>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Update Materi
                </button>
                <a href="{{ route('admin.materials.index', $material->training_id) }}" class="px-6 py-3 rounded-2xl bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>