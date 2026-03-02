<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sesi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow border border-slate-200 p-6">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">Edit Sesi Training</h1>
        <p class="text-slate-500 mb-6">{{ $session->training->title ?? '-' }}</p>

        <form method="POST" action="{{ route('admin.sessions.update', $session->id) }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Sesi</label>
                <input type="text" name="session_name" value="{{ $session->session_name }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Hari</label>
                    <input type="text" name="day_name" value="{{ $session->day_name }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal</label>
                    <input type="date" name="session_date" value="{{ optional($session->session_date)->format('Y-m-d') }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jam Mulai</label>
                    <input type="time" name="start_time" value="{{ $session->start_time }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jam Selesai</label>
                    <input type="time" name="end_time" value="{{ $session->end_time }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kuota</label>
                    <input type="number" name="quota" min="1" value="{{ $session->quota }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Quiz Open</label>
                    <input type="datetime-local" name="quiz_open_at"
                           value="{{ $session->quiz_open_at ? $session->quiz_open_at->format('Y-m-d\TH:i') : '' }}"
                           class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Quiz Close</label>
                    <input type="datetime-local" name="quiz_close_at"
                           value="{{ $session->quiz_close_at ? $session->quiz_close_at->format('Y-m-d\TH:i') : '' }}"
                           class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Link Materi</label>
                <input type="url" name="material_link" value="{{ $session->material_link }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Link Diklat / Sertifikat</label>
                <input type="url" name="diklat_link" value="{{ $session->diklat_link }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" {{ $session->is_active ? 'checked' : '' }} class="rounded border-slate-300">
                <label class="text-sm font-semibold text-slate-700">Aktifkan sesi</label>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Update Sesi
                </button>
                <a href="{{ route('admin.trainings.index') }}" class="px-6 py-3 rounded-2xl bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>