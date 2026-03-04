<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Peserta</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="frame-body">
    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Registrasi Peserta</div>
                <div class="section-subtitle">Kelola pendaftaran peserta training, approve, reject, atau hapus agar bisa daftar ulang</div>
            </div>
            <span class="badge badge-green">Admin Panel</span>
        </div>

        @if(session('success'))
            <div class="alert-box alert-success-box">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-box alert-danger-box">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="grid grid-4">
        <div class="card card-accent-blue card-soft-blue">
            <div class="card-title">Total Registrasi</div>
            <div class="card-value">{{ $registrations->total() }}</div>
            <div class="card-note">Semua data hasil filter</div>
        </div>

        <div class="card card-accent-orange card-soft-orange">
            <div class="card-title">Pending</div>
            <div class="card-value">{{ $summaryPending }}</div>
            <div class="card-note">Menunggu persetujuan admin</div>
        </div>

        <div class="card card-accent-green card-soft-green">
            <div class="card-title">Approved</div>
            <div class="card-value">{{ $summaryApproved }}</div>
            <div class="card-note">Sudah disetujui</div>
        </div>

        <div class="card card-accent-red card-soft-red">
            <div class="card-title">Rejected</div>
            <div class="card-value">{{ $summaryRejected }}</div>
            <div class="card-note">Ditolak admin</div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Filter Registrasi</div>
                <div class="section-subtitle">Saring berdasarkan training, sesi, atau status</div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.registrations.index') }}" class="admin-form">
            <div class="form-grid form-grid-4">
                <div class="form-group">
                    <label class="form-label">Training</label>
                    <select name="training_id" class="form-control">
                        <option value="">Semua training</option>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}" {{ request('training_id') == $training->id ? 'selected' : '' }}>
                                {{ $training->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Sesi</label>
                    <select name="session_id" class="form-control">
                        <option value="">Semua sesi</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}" {{ request('session_id') == $session->id ? 'selected' : '' }}>
                                {{ $session->session_name }} - {{ $session->training->title ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-blue">Filter</button>
                        <a href="{{ route('admin.registrations.index') }}" class="btn btn-light">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Daftar Peserta Terdaftar</div>
                <div class="section-subtitle">Approve, reject, atau hapus data registrasi peserta</div>
            </div>
        </div>

        <div class="table-wrap">
            <table class="table registration-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Peserta</th>
                        <th>Training</th>
                        <th>Sesi</th>
                        <th>Status</th>
                        <th>Waktu Daftar</th>
                        <th width="260">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $index => $registration)
                        <tr>
                            <td>{{ $registrations->firstItem() + $index }}</td>

                            <td>
                                <div class="cell-title">{{ $registration->user->name ?? '-' }}</div>
                                <div class="cell-sub">{{ $registration->user->employee_id ?? '-' }}</div>
                                <div class="cell-sub">{{ $registration->user->email ?? '-' }}</div>
                            </td>

                            <td>
                                <div class="cell-title">{{ $registration->training->title ?? '-' }}</div>
                                <div class="cell-sub">{{ $registration->training->category->name ?? '-' }}</div>
                            </td>

                            <td>
                                <div class="cell-title">{{ $registration->session->session_name ?? '-' }}</div>
                                <div class="cell-sub">
                                    {{ $registration->session && $registration->session->session_date ? \Carbon\Carbon::parse($registration->session->session_date)->format('d M Y') : '-' }}
                                </div>
                                <div class="cell-sub">
                                    {{ $registration->session->start_time ?? '-' }} - {{ $registration->session->end_time ?? '-' }}
                                </div>
                            </td>

                            <td>
                                @if($registration->status === 'pending')
                                    <span class="badge badge-orange">Pending</span>
                                @elseif($registration->status === 'approved')
                                    <span class="badge badge-green">Approved</span>
                                @elseif($registration->status === 'rejected')
                                    <span class="badge badge-red">Rejected</span>
                                @elseif($registration->status === 'cancelled')
                                    <span class="badge badge-purple">Cancelled</span>
                                @else
                                    <span class="badge badge-blue">{{ ucfirst($registration->status ?? '-') }}</span>
                                @endif
                            </td>

                            <td>
                                <div class="cell-title">
                                    @if(!empty($registration->registered_at))
                                        {{ \Carbon\Carbon::parse($registration->registered_at)->format('d M Y H:i') }}
                                    @elseif(!empty($registration->created_at))
                                        {{ $registration->created_at->format('d M Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div class="action-stack">
                                    @if($registration->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.registrations.approve', $registration->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-green btn-sm">Approve</button>
                                        </form>
                                    @endif

                                    @if($registration->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.registrations.reject', $registration->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-orange btn-sm">Reject</button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.registrations.destroy', $registration->id) }}"
                                          onsubmit="return confirm('Hapus registrasi ini? Peserta akan bisa daftar ulang.')">
                                        @csrf
                                        <button type="submit" class="btn btn-red btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-box" style="margin:16px;">
                                    Belum ada data registrasi peserta.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
            <div class="pagination-wrap">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>
</body>
</html>