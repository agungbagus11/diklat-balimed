<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Training</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen p-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Materi Training</h1>
            <p class="text-slate-500 mt-2">{{ $training->title }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.trainings.index') }}"
               class="px-5 py-3 rounded-2xl bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">
                Kembali
            </a>
            <a href="{{ route('admin.materials.create', $training->id) }}"
               class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                + Tambah Materi
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($training->materials as $material)
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">
                                {{ strtoupper($material->type) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $material->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-700' }}">
                                {{ $material->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>

                        <h2 class="text-2xl font-extrabold text-slate-800">{{ $material->title }}</h2>
                        <p class="text-sm text-slate-500 mt-2 break-all">{{ $material->url }}</p>
                        <p class="text-sm text-slate-600 mt-2">{{ $material->description ?: '-' }}</p>
                        <p class="text-xs text-slate-400 mt-2">Urutan: {{ $material->sort_order }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ $material->url }}" target="_blank"
                           class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                            Buka
                        </a>

                        <a href="{{ route('admin.materials.edit', $material->id) }}"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.materials.toggle', $material->id) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">
                                Toggle
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.materials.destroy', $material->id) }}"
                              onsubmit="return confirm('Hapus materi ini?')">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-8 text-center text-slate-500">
                Belum ada materi untuk training ini.
            </div>
        @endforelse
    </div>
</body>
</html>