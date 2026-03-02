<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen p-6">
    <div class="mb-8">
        <div class="rounded-3xl bg-white p-6 shadow border border-slate-200">
            <h1 class="text-3xl font-extrabold text-slate-800">
                Admin Panel — DIKLAT RS BALIMED DENPASAR
            </h1>
            <p class="text-slate-500 mt-2">
                Ringkasan awal sistem diklat. Dashboard ini nanti akan kita upgrade seperti mockup kamu.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="rounded-3xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Total Karyawan</p>
            <h3 class="text-4xl font-extrabold mt-2">{{ \App\Models\Employee::count() }}</h3>
            <p class="mt-3 text-sm text-white/90">Data dari import master karyawan</p>
        </div>

        <div class="rounded-3xl bg-gradient-to-r from-emerald-500 to-green-600 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Total Users</p>
            <h3 class="text-4xl font-extrabold mt-2">{{ \App\Models\User::count() }}</h3>
            <p class="mt-3 text-sm text-white/90">Akun login sistem</p>
        </div>

        <div class="rounded-3xl bg-gradient-to-r from-purple-500 to-fuchsia-600 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Total Training</p>
            <h3 class="text-4xl font-extrabold mt-2">0</h3>
            <p class="mt-3 text-sm text-white/90">Belum dibuat</p>
        </div>

        <div class="rounded-3xl bg-gradient-to-r from-orange-500 to-amber-500 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Total Sertifikat</p>
            <h3 class="text-4xl font-extrabold mt-2">0</h3>
            <p class="mt-3 text-sm text-white/90">Belum ada sertifikat</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl shadow p-6 border border-slate-200">
            <h2 class="text-xl font-bold text-slate-800">Menu Admin Awal</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="rounded-2xl border border-slate-200 p-4 hover:shadow transition">
                    <h3 class="font-bold text-slate-800">Kelola Karyawan</h3>
                    <p class="text-sm text-slate-500 mt-1">Data master karyawan dari CSV</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 hover:shadow transition">
                    <h3 class="font-bold text-slate-800">Kelola User</h3>
                    <p class="text-sm text-slate-500 mt-1">Akun login dan role</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 hover:shadow transition">
                    <h3 class="font-bold text-slate-800">Manajemen Training</h3>
                    <p class="text-sm text-slate-500 mt-1">Internal, Webinar, External</p>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="/admin/trainings"
                        class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                        Buka Manajemen Training
                    </a>
                    <a href="/admin/registrations"
                        class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                        Buka Manajemen Registrasi
                    </a>
                </div>
                <div class="rounded-2xl border border-slate-200 p-4 hover:shadow transition">
                    <h3 class="font-bold text-slate-800">Kuis & Sertifikat</h3>
                    <p class="text-sm text-slate-500 mt-1">Essay, MCQ, dan sertifikat otomatis</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow p-6 border border-slate-200">
            <h2 class="text-xl font-bold text-slate-800">Aktivitas Terbaru</h2>
            <div class="mt-4 space-y-4 text-sm text-slate-600">
                <div class="border-b pb-3">
                    <p class="font-semibold text-slate-800">System Ready</p>
                    <p>Portal fondasi berhasil disiapkan.</p>
                </div>
                <div class="border-b pb-3">
                    <p class="font-semibold text-slate-800">Role & User</p>
                    <p>Struktur role sudah tersedia dan siap dipakai.</p>
                </div>
                <div>
                    <p class="font-semibold text-slate-800">Next Step</p>
                    <p>Bangun modul training, sesi, registrasi, dan quiz.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>