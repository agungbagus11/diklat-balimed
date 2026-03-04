<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sesi Training</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body class="frame-body">
    <div class="form-shell">
        <div class="section-card">
            <div class="section-header">
                <div>
                    <div class="section-title">Tambah Sesi Training</div>
                    <div class="section-subtitle"><?php echo e($training->title); ?></div>
                </div>
                <a href="<?php echo e(route('admin.trainings.index')); ?>" class="btn btn-light">Kembali</a>
            </div>

            <form method="POST" action="<?php echo e(route('admin.sessions.store', $training->id)); ?>" class="admin-form">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label class="form-label">Nama Sesi</label>
                    <input type="text" name="session_name" value="<?php echo e(old('session_name')); ?>" class="form-control" placeholder="Contoh: Sesi Pagi BTLS">
                </div>

                <div class="form-grid form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Hari</label>
                        <input type="text" name="day_name" value="<?php echo e(old('day_name')); ?>" class="form-control" placeholder="Senin">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="session_date" value="<?php echo e(old('session_date')); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="start_time" value="<?php echo e(old('start_time')); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="end_time" value="<?php echo e(old('end_time')); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">Kuota</label>
                        <input type="number" name="quota" value="<?php echo e(old('quota', 30)); ?>" class="form-control" min="1">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quiz Dibuka</label>
                        <input type="datetime-local" name="quiz_open_at" value="<?php echo e(old('quiz_open_at')); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quiz Ditutup</label>
                        <input type="datetime-local" name="quiz_close_at" value="<?php echo e(old('quiz_close_at')); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Link Materi</label>
                    <input type="url" name="material_link" value="<?php echo e(old('material_link')); ?>" class="form-control" placeholder="https://...">
                </div>

                <div class="form-group">
                    <label class="form-label">Link Diklat / Sertifikat</label>
                    <input type="url" name="diklat_link" value="<?php echo e(old('diklat_link')); ?>" class="form-control" placeholder="https://...">
                </div>

                <div class="check-row">
                    <label class="remember-label">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', 1) ? 'checked' : ''); ?>>
                        <span>Aktifkan sesi</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-purple">Simpan Sesi</button>
                    <a href="<?php echo e(route('admin.trainings.index')); ?>" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/admin/sessions/create.blade.php ENDPATH**/ ?>