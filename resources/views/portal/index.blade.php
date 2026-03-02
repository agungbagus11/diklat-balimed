<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal DIKLAT RS BALIMED DENPASAR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen overflow-hidden">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside
            class="w-72 bg-gradient-to-b from-indigo-600 via-blue-600 to-purple-700 text-white shadow-2xl hidden md:flex flex-col">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <img src="https://rsbalimed.com/wp-content/uploads/2022/09/logo-balimed-hospital.png"
                        class="h-12 w-12 object-contain bg-white rounded-xl p-1" alt="Logo">
                    <div>
                        <h1 class="text-lg font-extrabold leading-tight">DIKLAT RS BALIMED</h1>
                        <p class="text-sm text-white/80">Denpasar • Portal 2025/2026</p>
                    </div>
                </div>
            </div>

            <div class="p-4 space-y-2 flex-1 overflow-y-auto">
                <button onclick="loadFrame('/user/home')" class="nav-btn">Dashboard</button>
                <button onclick="loadFrame('/user/trainings')" class="nav-btn">Internal Training</button>
                <button onclick="loadFrame('/user/trainings')" class="nav-btn">Webinar</button>
                <button onclick="loadFrame('/user/trainings')" class="nav-btn">External Training</button>
                <button onclick="loadFrame('/user/trainings')" class="nav-btn">Jadwal Diklat</button>
                <button onclick="loadFrame('/user/my-registrations')" class="nav-btn">Registrasi</button>
                <button onclick="loadFrame('/user/materials')" class="nav-btn">Materi</button>
                <button onclick="loadFrame('/user/home')" class="nav-btn">Kuis</button>
                <button onclick="loadFrame('/user/home')" class="nav-btn">Hasil Kuis</button>
                <button onclick="loadFrame('/user/home')" class="nav-btn">Sertifikat</button>

                @if(auth()->user()->hasAnyRole(['super_admin', 'admin_diklat']) || in_array(auth()->user()->role_label, ['super_admin', 'admin_diklat']))
                    <button onclick="loadFrame('/admin/dashboard')"
                        class="nav-btn bg-amber-400/20 border border-amber-300/20">
                        Admin Panel
                    </button>

                    <button onclick="loadFrame('/admin/registrations')" class="nav-btn bg-white/10">
                        Kelola Registrasi
                    </button>
                @endif
                <button onclick="loadFrame('/admin/trainings')" class="nav-btn bg-white/10">
                    Manajemen Training
                </button>
                
                <div class="p-4 border-t border-white/10">
                    <div class="rounded-2xl bg-white/10 px-4 py-3">
                        <p class="text-sm text-white/70">Login sebagai</p>
                        <p class="font-bold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-white/70 mt-1">{{ auth()->user()->employee_id }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full rounded-2xl bg-red-500 hover:bg-red-600 transition px-4 py-3 font-semibold">
                            Logout
                        </button>
                    </form>
                </div>
        </aside>

        <!-- Main -->
        <main class="flex-1 flex flex-col">
            <!-- Topbar -->
            <div class="bg-white shadow-sm border-b px-4 md:px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800">
                        DIKLAT RS BALIMED DENPASAR
                    </h2>
                    <p class="text-sm text-slate-500">
                        Rumah aplikasi pelatihan, kuis, dan sertifikat
                    </p>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <div class="rounded-full bg-indigo-50 text-indigo-700 px-4 py-2 text-sm font-semibold">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </div>

            <!-- Mobile menu info -->
            <div class="md:hidden bg-yellow-50 border-b border-yellow-200 px-4 py-3 text-sm text-yellow-700">
                Tampilan mobile sidebar belum aktif penuh. Fokus dulu desktop foundation.
            </div>

            <!-- Iframe container -->
            <div class="flex-1 p-4 md:p-6">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden h-full border border-slate-200">
                    <iframe id="mainFrame" src="/user/home"
                        class="w-full h-full border-0 transition-opacity duration-300"></iframe>
                </div>
            </div>
        </main>
    </div>

    <style>
        .nav-btn {
            width: 100%;
            text-align: left;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, .08);
            transition: .25s ease;
            font-weight: 600;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, .18);
            transform: translateX(4px);
        }
    </style>

    <script>
        function loadFrame(url) {
            const frame = document.getElementById('mainFrame');
            frame.style.opacity = '0';
            setTimeout(() => {
                frame.src = url;
                frame.style.opacity = '1';
            }, 180);
        }
    </script>
</body>

</html>