<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Training</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow border border-slate-200 p-6">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Edit Training</h1>

        <form method="POST" action="{{ route('admin.trainings.update', $training->id) }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                    <select name="training_category_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $training->training_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kode Training</label>
                    <input type="text" name="code" value="{{ $training->code }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Training</label>
                <input type="text" name="title" value="{{ $training->title }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-300 px-4 py-3">{{ $training->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Penyelenggara</label>
                    <input type="text" name="organizer" value="{{ $training->organizer }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi</label>
                    <input type="text" name="location" value="{{ $training->location }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Metode</label>
                    <select name="method" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                        <option value="offline" {{ $training->method === 'offline' ? 'selected' : '' }}>Offline</option>
                        <option value="online" {{ $training->method === 'online' ? 'selected' : '' }}>Online</option>
                        <option value="hybrid" {{ $training->method === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" {{ $training->is_active ? 'checked' : '' }} class="rounded border-slate-300">
                <label class="text-sm font-semibold text-slate-700">Aktifkan training</label>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Update
                </button>
                <a href="{{ route('admin.trainings.index') }}" class="px-6 py-3 rounded-2xl bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>