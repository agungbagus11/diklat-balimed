<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Training</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="frame-body">
    <div class="form-shell">
        <div class="section-card">
            <div class="section-header">
                <div>
                    <div class="section-title">Edit Training</div>
                    <div class="section-subtitle">Perbarui data training, kategori, metode, dan informasi utama</div>
                </div>
                <a href="{{ route('admin.trainings.index') }}" class="btn btn-light">Kembali</a>
            </div>

            @if($errors->any())
                <div class="alert-box alert-danger-box">
                    Mohon cek kembali form. Masih ada data yang belum valid.
                </div>
            @endif

            <form method="POST" action="{{ route('admin.trainings.update', $training->id) }}" class="admin-form">
                @csrf

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Kategori Training</label>
                        <select name="training_category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('training_category_id', $training->training_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kode Training</label>
                        <input type="text" name="code" value="{{ old('code', $training->code) }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Training</label>
                    <input type="text" name="title" value="{{ old('title', $training->title) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $training->description) }}</textarea>
                </div>

                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">Penyelenggara</label>
                        <input type="text" name="organizer" value="{{ old('organizer', $training->organizer) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $training->location) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode</label>
                        <select name="method" class="form-control">
                            <option value="offline" {{ old('method', $training->method) === 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="online" {{ old('method', $training->method) === 'online' ? 'selected' : '' }}>Online</option>
                            <option value="hybrid" {{ old('method', $training->method) === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                </div>

                <div class="check-row">
                    <label class="remember-label">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $training->is_active) ? 'checked' : '' }}>
                        <span>Aktifkan training</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-blue">Update Training</button>
                    <a href="{{ route('admin.trainings.index') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>