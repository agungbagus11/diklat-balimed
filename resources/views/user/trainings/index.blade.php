<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Training</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-800">Daftar Training</h1>
        <p class="text-slate-500 mt-2">Internal Training, Webinar, dan External Training yang tersedia.</p>
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

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @forelse($trainings as $training)
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 mb-3">
                            {{ $training->category->name ?? '-' }}
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-800">{{ $training->title }}</h2>
                        <p class="text-sm text-slate-500 mt-1">Kode: {{ $training->code }}</p>
                    </div>
                    <div class="text-sm font-semibold px-3 py-1 rounded-full {{ $training->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $training->is_active ? 'Aktif' : 'Nonaktif' }}
                    </div>
                </div>

                <div class="mt-4 text-slate-600 text-sm space-y-2">
                    <p><strong>Penyelenggara:</strong> {{ $training->organizer ?: '-' }}</p>
                    <p><strong>Lokasi:</strong> {{ $training->location ?: '-' }}</p>
                    <p><strong>Metode:</strong> {{ ucfirst($training->method) }}</p>
                    <p><strong>Deskripsi:</strong> {{ $training->description ?: '-' }}</p>
                </div>

                <div class="mt-5">
                    <h3 class="font-bold text-slate-800 mb-3">Sesi Training</h3>

                    <div class="space-y-3">
                        @forelse($training->sessions as $session)
                            @php
                                $usedQuota = \App\Models\Registration::where('training_session_id', $session->id)
                                    ->whereIn('status', ['pending', 'approved'])
                                    ->count();

                                $remainingQuota = max(0, $session->quota - $usedQuota);

                                $myRegistration = \App\Models\Registration::where('training_session_id', $session->id)
                                    ->where('user_id', auth()->id())
                                    ->first();
                            @endphp

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $session->session_name }}</p>
                                        <p class="text-sm text-slate-500">
                                            {{ $session->day_name }} • {{ optional($session->session_date)->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            {{ $session->start_time }} - {{ $session->end_time }}
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-sm text-slate-500">Sisa Kuota</p>
                                        <p class="font-bold {{ $remainingQuota > 0 ? 'text-indigo-600' : 'text-red-600' }}">
                                            {{ $remainingQuota }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-3 items-center">
                                    @if($myRegistration)
                                        <span class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 font-semibold">
                                            Sudah daftar ({{ ucfirst($myRegistration->status) }})
                                        </span>
                                    @elseif($remainingQuota <= 0)
                                        <span class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-semibold">
                                            Kuota Penuh
                                        </span>
                                    @else
                                        <form method="POST" action="{{ route('user.trainings.register', $session->id) }}">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                                                Daftar
                                            </button>
                                        </form>
                                    @endif
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
            <div class="col-span-full bg-white rounded-3xl shadow border border-slate-200 p-8 text-center text-slate-500">
                Belum ada data training.
            </div>
        @endforelse
    </div>
</body>
</html>