<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sesi Training</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="frame-body">
    <div class="form-shell">
        <div class="section-card">
            <div class="section-header">
                <div>
                    <div class="section-title">Edit Sesi Training</div>
                    <div class="section-subtitle">{{ $session->training->title ?? '-' }}</div>
                </div>
                <a href="{{ route('admin.trainings.index') }}" class="btn btn-light">Kembali</a>
            </div>

            <form method="POST" action="{{ route('admin.sessions.update', $session->id) }}" class="admin-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">Nama Sesi</label>
                    <input type="text" name="session_name" value="{{ old('session_name', $session->session_name) }}" class="form-control">
                </div>

                <div class="form-grid form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Hari</label>
                        <input type="text" name="day_name" value="{{ old('day_name', $session->day_name) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="session_date" value="{{ old('session_date', $session->session_date ? \Carbon\Carbon::parse($session->session_date)->format('Y-m-d') : '') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="start_time" value="{{ old('start_time', $session->start_time) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="end_time" value="{{ old('end_time', $session->end_time) }}" class="form-control">
                    </div>
                </div>

                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">Kuota</label>
                        <input type="number" name="quota" value="{{ old('quota', $session->quota) }}" class="form-control" min="1">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quiz Dibuka</label>
                        <input type="datetime-local" name="quiz_open_at" value="{{ old('quiz_open_at', $session->quiz_open_at ? $session->quiz_open_at->format('Y-m-d\TH:i') : '') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quiz Ditutup</label>
                        <input type="datetime-local" name="quiz_close_at" value="{{ old('quiz_close_at', $session->quiz_close_at ? $session->quiz_close_at->format('Y-m-d\TH:i') : '') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Link Materi</label>
                    <input type="url" name="material_link" value="{{ old('material_link', $session->material_link) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Link Diklat / Sertifikat</label>
                    <input type="url" name="diklat_link" value="{{ old('diklat_link', $session->diklat_link) }}" class="form-control">
                </div>

                <div class="check-row">
                    <label class="remember-label">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $session->is_active) ? 'checked' : '' }}>
                        <span>Aktifkan sesi</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-purple">Update Sesi</button>
                    <a href="{{ route('admin.trainings.index') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>