<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 min-h-screen p-6">
    <div class="mb-8">
        <div class="rounded-3xl bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-600 text-white p-8 shadow-xl">
            <h1 class="text-3xl font-extrabold">
                Welcome back, {{ auth()->user()->name }} 👋
            </h1>
            <p class="mt-2 text-white/90">
                Selamat datang di portal DIKLAT RS BALIMED DENPASAR.
                Nanti di sini akan terintegrasi Internal Training, Webinar, External Training, Kuis, dan Sertifikat.
            </p>
        </div>
    </div>
    <div class="mt-6 flex flex-wrap gap-3">
        <a href="/user/trainings"
            class="inline-block px-5 py-3 rounded-2xl bg-white text-indigo-700 font-bold shadow hover:shadow-lg transition">
            Lihat Training
        </a>
        <a href="/user/my-registrations"
            class="inline-block px-5 py-3 rounded-2xl bg-indigo-900/20 text-white font-bold border border-white/20 hover:bg-indigo-900/30 transition">
            Registrasi Saya
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="rounded-3xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Jadwal Pelatihan</p>
            <h3 class="text-4xl font-extrabold mt-2">0</h3>
            <p class="mt-3 text-sm text-white/90">Belum ada data training aktif</p>
        </div>

        <div class="rounded-3xl bg-gradient-to-r from-emerald-500 to-green-600 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Kuis Aktif</p>
            <h3 class="text-4xl font-extrabold mt-2">0</h3>
            <p class="mt-3 text-sm text-white/90">Belum ada kuis tersedia</p>
        </div>

        <div class="rounded-3xl bg-gradient-to-r from-purple-500 to-pink-600 text-white p-6 shadow-lg">
            <p class="text-sm text-white/80">Sertifikat Saya</p>
            <h3 class="text-4xl font-extrabold mt-2">0</h3>
            <p class="mt-3 text-sm text-white/90">Belum ada sertifikat terbit</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl shadow p-6 border border-slate-200">
            <h2 class="text-xl font-bold text-slate-800">Fitur User</h2>
            <ul class="mt-4 space-y-3 text-slate-600">
                <li>• Melihat jadwal pelatihan</li>
                <li>• Mendaftar pelatihan</li>
                <li>• Melihat materi</li>
                <li>• Mengikuti kuis essay & multiple choice</li>
                <li>• Melihat hasil kuis</li>
                <li>• Download sertifikat</li>
            </ul>
        </div>

        <div class="bg-white rounded-3xl shadow p-6 border border-slate-200">
            <h2 class="text-xl font-bold text-slate-800">Status Pengembangan</h2>
            <div class="mt-4 space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Fondasi Login</span>
                        <span class="font-semibold text-green-600">100%</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-green-500 h-3 rounded-full w-full"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Portal Shell</span>
                        <span class="font-semibold text-blue-600">80%</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-blue-500 h-3 rounded-full w-4/5"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Modul Training</span>
                        <span class="font-semibold text-amber-600">0%</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3">
                        <div class="bg-amber-500 h-3 rounded-full w-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>