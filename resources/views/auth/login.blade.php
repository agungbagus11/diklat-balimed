<x-guest-layout>
    <div class="w-full max-w-md">
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/30">
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 flex justify-center">
                    <img src="https://rsbalimed.com/wp-content/uploads/2022/09/logo-balimed-hospital.png"
                         alt="Logo BaliMed"
                         class="h-16 object-contain">
                </div>

                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    DIKLAT RS BALIMED DENPASAR
                </h1>
                <p class="text-slate-500 mt-2 text-sm">
                    Portal Internal Training, Webinar, dan External Training
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="employee_id" class="block text-sm font-semibold text-slate-700 mb-2">
                        ID Karyawan
                    </label>
                    <input
                        id="employee_id"
                        name="employee_id"
                        type="text"
                        value="{{ old('employee_id') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                        placeholder="Masukkan ID Karyawan">
                    @error('employee_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                        placeholder="Password default: balimed1">
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold py-3.5 shadow-lg hover:scale-[1.01] hover:shadow-xl transition duration-300">
                    Login ke Sistem
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500">
                Version 1.0.0 | © {{ date('Y') }} BaliMed Hospital
            </div>
        </div>
    </div>
</x-guest-layout>