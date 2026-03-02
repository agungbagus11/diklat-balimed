<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-800">Registrasi Saya</h1>
        <p class="text-slate-500 mt-2">Daftar pelatihan yang sudah Anda ikuti atau daftarkan.</p>
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

    <div class="bg-white rounded-3xl shadow border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Training</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Sesi</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $item)
                        <tr class="border-t">
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
                                @php
                                    $statusClass = match($item->status) {
                                        'approved' => 'bg-green-100 text-green-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                        'cancelled' => 'bg-slate-100 text-slate-700',
                                        default => 'bg-slate-100 text-slate-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if(in_array($item->status, ['pending', 'approved']))
                                    <form method="POST" action="{{ route('user.registrations.cancel', $item->id) }}"
                                          onsubmit="return confirm('Batalkan registrasi ini?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                            Batalkan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                                Belum ada registrasi training.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>