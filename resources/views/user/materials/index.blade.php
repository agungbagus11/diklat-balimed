<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Training</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-800">Materi Training</h1>
        <p class="text-slate-500 mt-2">Materi aktif dari training yang tersedia.</p>
    </div>

    <div class="space-y-6">
        @forelse($trainings as $training)
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-6">
                <div class="mb-4">
                    <div class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 mb-3">
                        {{ $training->category->name ?? '-' }}
                    </div>
                    <h2 class="text-2xl font-extrabold text-slate-800">{{ $training->title }}</h2>
                    <p class="text-sm text-slate-500 mt-1">{{ $training->description ?: '-' }}</p>
                </div>

                <div class="space-y-3">
                    @foreach($training->materials->where('is_active', 1) as $material)
                        <div class="rounded-2xl border border-slate-200 p-4 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                        {{ strtoupper($material->type) }}
                                    </span>
                                </div>
                                <p class="font-bold text-slate-800">{{ $material->title }}</p>
                                <p class="text-sm text-slate-500">{{ $material->description ?: '-' }}</p>
                            </div>

                            <a href="{{ $material->url }}" target="_blank"
                               class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                                Buka Materi
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-8 text-center text-slate-500">
                Belum ada materi tersedia.
            </div>
        @endforelse
    </div>
</body>
</html>