<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registrations</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Registrasi Training</h1>
        <p class="text-slate-500 mt-2">Approve, reject, dan hapus peserta terdaftar.</p>
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

    <div class="bg-white rounded-3xl shadow border border-slate-200 p-5 mb-6">
        <form method="GET" action="{{ route('admin.registrations.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Training</label>
                <select name="training_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                    <option value="">Semua Training</option>
                    @foreach($trainings as $training)
                        <option value="{{ $training->id }}" {{ (string)$trainingId === (string)$training->id ? 'selected' : '' }}>
                            {{ $training->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Sesi</label>
                <select name="session_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                    <option value="">Semua Sesi</option>
                    @foreach($sessions as $session)
                        <option value="{{ $session->id }}" {{ (string)$sessionId === (string)$session->id ? 'selected' : '' }}>
                            {{ $session->session_name }} - {{ optional($session->session_date)->format('d M Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                <select name="status" class="w-full rounded-2xl border border-slate-300 px-4 py-3">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="submit" class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Filter
                </button>
                <a href="{{ route('admin.registrations.index') }}" class="px-5 py-3 rounded-2xl bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="rounded-3xl bg-yellow-100 text-yellow-800 p-5 shadow-sm">
            <p class="text-sm">Pending</p>
            <h3 class="text-3xl font-extrabold mt-2">{{ $registrations->where('status', 'pending')->count() }}</h3>
        </div>
        <div class="rounded-3xl bg-green-100 text-green-800 p-5 shadow-sm">
            <p class="text-sm">Approved</p>
            <h3 class="text-3xl font-extrabold mt-2">{{ $registrations->where('status', 'approved')->count() }}</h3>
        </div>
        <div class="rounded-3xl bg-red-100 text-red-800 p-5 shadow-sm">
            <p class="text-sm">Rejected</p>
            <h3 class="text-3xl font-extrabold mt-2">{{ $registrations->where('status', 'rejected')->count() }}</h3>
        </div>
        <div class="rounded-3xl bg-slate-100 text-slate-800 p-5 shadow-sm">
            <p class="text-sm">Total</p>
            <h3 class="text-3xl font-extrabold mt-2">{{ $registrations->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Peserta</th>
                        <th class="px-4 py-3 text-left">Training</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Sesi</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Daftar</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $item)
                        @php
                            $statusClass = match($item->status) {
                                'approved' => 'bg-green-100 text-green-700',
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'rejected' => 'bg-red-100 text-red-700',
                                'cancelled' => 'bg-slate-100 text-slate-700',
                                default => 'bg-slate-100 text-slate-700',
                            };
                        @endphp

                        <tr class="border-t align-top">
                            <td class="px-4 py-3">
                                <div class="font-bold text-slate-800">{{ $item->user->name ?? '-' }}</div>
                                <div class="text-slate-500 text-xs">{{ $item->user->employee_id ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-slate-800">
                                {{ $item->training->title ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $item->training->category->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $item->session->session_name ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ optional($item->session->session_date)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                {{ optional($item->registered_at)->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @if(in_array($item->status, ['pending', 'rejected']))
                                        <form method="POST" action="{{ route('admin.registrations.approve', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700 transition">
                                                Approve
                                            </button>
                                        </form>
                                    @endif

                                    @if(in_array($item->status, ['pending', 'approved']))
                                        <form method="POST" action="{{ route('admin.registrations.reject', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-2 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">
                                                Reject
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.registrations.destroy', $item->id) }}"
                                          onsubmit="return confirm('Hapus registrasi ini? User akan bisa daftar ulang.')">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-slate-500">
                                Belum ada data registrasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>