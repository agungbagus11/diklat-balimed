<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Training</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="frame-body">
    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Manajemen Training</div>
                <div class="section-subtitle">Kelola training, kategori, sesi, jadwal, kuota, dan link materi</div>
            </div>
            <a href="{{ route('admin.trainings.create') }}" class="btn btn-blue">+ Tambah Training</a>
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

    <div class="training-stack">
        @forelse($trainings as $training)
            <div class="training-card">
                <div class="training-top">
                    <div>
                        <div class="training-badges">
                            <span class="badge badge-blue">{{ $training->category->name ?? 'Tanpa Kategori' }}</span>
                            @if($training->is_active)
                                <span class="badge badge-green">Aktif</span>
                            @else
                                <span class="badge badge-red">Nonaktif</span>
                            @endif
                            <span class="badge badge-purple">{{ strtoupper($training->method ?? '-') }}</span>
                        </div>

                        <h2 class="training-title">{{ $training->title }}</h2>
                        <div class="training-code">Kode: {{ $training->code }}</div>
                        <p class="training-desc">{{ $training->description ?: 'Belum ada deskripsi training.' }}</p>
                    </div>

                    <div class="training-actions">
                        <a href="{{ route('admin.trainings.edit', $training->id) }}" class="btn btn-blue">Edit</a>

                        <form method="POST" action="{{ route('admin.trainings.toggle', $training->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-orange">Toggle</button>
                        </form>

                        <a href="{{ route('admin.materials.index', $training->id) }}" class="btn btn-green">Materi</a>

                        <a href="{{ route('admin.sessions.create', $training->id) }}" class="btn btn-purple">+ Sesi</a>

                        <form method="POST" action="{{ route('admin.trainings.destroy', $training->id) }}" onsubmit="return confirm('Hapus training ini beserta sesi terkait?')">
                            @csrf
                            <button type="submit" class="btn btn-red">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="training-meta-grid">
                    <div class="mini-info">
                        <div class="mini-label">Penyelenggara</div>
                        <div class="mini-value">{{ $training->organizer ?: '-' }}</div>
                    </div>
                    <div class="mini-info">
                        <div class="mini-label">Lokasi</div>
                        <div class="mini-value">{{ $training->location ?: '-' }}</div>
                    </div>
                    <div class="mini-info">
                        <div class="mini-label">Total Sesi</div>
                        <div class="mini-value">{{ $training->sessions->count() }}</div>
                    </div>
                </div>

                <div class="sessions-block">
                    <div class="sessions-title">Daftar Sesi</div>

                    @forelse($training->sessions as $session)
                        <div class="session-item">
                            <div class="session-main">
                                <div>
                                    <div class="session-name">{{ $session->session_name }}</div>
                                    <div class="session-sub">
                                        {{ $session->day_name ?: '-' }} ·
                                        {{ $session->session_date ? \Carbon\Carbon::parse($session->session_date)->format('d M Y') : '-' }} ·
                                        {{ $session->start_time ?: '-' }} - {{ $session->end_time ?: '-' }}
                                    </div>
                                    <div class="session-links">
                                        <span>Kuota: {{ $session->quota }}</span>
                                        <span>Materi: {{ $session->material_link ?: '-' }}</span>
                                        <span>Link Diklat: {{ $session->diklat_link ?: '-' }}</span>
                                    </div>
                                </div>

                                <div class="training-actions">
                                    @if($session->is_active)
                                        <span class="badge badge-green">Aktif</span>
                                    @else
                                        <span class="badge badge-red">Nonaktif</span>
                                    @endif

                                    <a href="{{ route('admin.sessions.edit', $session->id) }}" class="btn btn-blue">Edit</a>

                                    <form method="POST" action="{{ route('admin.sessions.toggle', $session->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-orange">Toggle</button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.sessions.destroy', $session->id) }}" onsubmit="return confirm('Hapus sesi ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-red">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-box">
                            Belum ada sesi untuk training ini.
                        </div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="section-card">
                <div class="empty-box">
                    Belum ada data training.
                </div>
            </div>
        @endforelse
    </div>
</body>
</html>