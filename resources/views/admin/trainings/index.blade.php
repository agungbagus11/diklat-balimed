<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Training</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen p-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Training</h1>
            <p class="text-slate-500 mt-2">Kelola training dan sesi training.</p>
        </div>
        <a href="{{ route('admin.trainings.create') }}"
            class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
            + Tambah Training
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-6">
        @forelse($trainings as $training)
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div
                            class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 mb-3">
                            {{ $training->category->name ?? '-' }}
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-800">{{ $training->title }}</h2>
                        <p class="text-sm text-slate-500 mt-1">Kode: {{ $training->code }}</p>
                        <div class="mt-3 text-sm text-slate-600 space-y-1">
                            <p><strong>Penyelenggara:</strong> {{ $training->organizer ?: '-' }}</p>
                            <p><strong>Lokasi:</strong> {{ $training->location ?: '-' }}</p>
                            <p><strong>Metode:</strong> {{ ucfirst($training->method) }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-2 rounded-xl text-sm font-bold {{ $training->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-700' }}">
                            {{ $training->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>

                        <a href="{{ route('admin.trainings.edit', $training->id) }}"
                            class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.trainings.toggle', $training->id) }}">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">
                                Toggle
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.trainings.destroy', $training->id) }}"
                            onsubmit="return confirm('Hapus training ini beserta semua sesi dan registrasi terkait?')">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                        <a href="{{ route('admin.materials.index', $training->id) }}"
                            class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                            Materi
                        </a>
                        <a href="{{ route('admin.sessions.create', $training->id) }}"
                            class="px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            + Tambah Sesi
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Daftar Sesi</h3>

                    <div class="space-y-3">
                        @forelse($training->sessions as $session)
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex flex-wrap items-start justify-between gap-4">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $session->session_name }}</p>
                                        <p class="text-sm text-slate-500">
                                            {{ $session->day_name }} • {{ optional($session->session_date)->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            {{ $session->start_time }} - {{ $session->end_time }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            Kuota: {{ $session->quota }}
                                        </p>
                                        <p class="text-sm text-slate-500 break-all">
                                            Materi: {{ $session->material_link ?: '-' }}
                                        </p>
                                        <p class="text-sm text-slate-500 break-all">
                                            Link Diklat: {{ $session->diklat_link ?: '-' }}
                                        </p>
                                    </div>

                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-2 rounded-xl text-sm font-bold {{ $session->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-700' }}">
                                            {{ $session->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>

                                        <a href="{{ route('admin.sessions.edit', $session->id) }}"
                                            class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.sessions.toggle', $session->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">
                                                Toggle
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.sessions.destroy', $session->id) }}"
                                            onsubmit="return confirm('Hapus sesi ini?')">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-slate-300 p-4 text-slate-500">
                                Belum ada sesi untuk training ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-8 text-center text-slate-500">
                Belum ada data training.
            </div>
        @endforelse
    </div>
</body>

</html>