<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body class="frame-body">
    <div class="frame-grid frame-grid-3">
        <div class="card card-accent-blue card-soft-blue">
            <div class="card-title">Jadwal Pelatihan</div>
            <div class="card-value"><?php echo e(\App\Models\TrainingSession::where('is_active', 1)->count()); ?></div>
            <div class="card-note">Sesi aktif tersedia</div>
        </div>

        <div class="card card-accent-green card-soft-green">
            <div class="card-title">Registrasi Saya</div>
            <div class="card-value"><?php echo e(\App\Models\Registration::where('user_id', auth()->id())->count()); ?></div>
            <div class="card-note">Total riwayat pendaftaran</div>
        </div>

        <div class="card card-accent-purple card-soft-purple">
            <div class="card-title">Materi Tersedia</div>
            <div class="card-value"><?php echo e(\App\Models\Material::where('is_active', 1)->count()); ?></div>
            <div class="card-note">Materi aktif untuk dipelajari</div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Fitur User</div>
                <div class="section-subtitle">Akses utama untuk peserta diklat</div>
            </div>
            <span class="badge badge-blue">Portal User</span>
        </div>

        <div class="menu-grid">
            <div class="menu-item">
                <span class="badge badge-blue">Training</span>
                <h3>Lihat Jadwal Pelatihan</h3>
                <p>Melihat training, webinar, external training, sesi pelatihan, tanggal, waktu, dan kuota.</p>
            </div>

            <div class="menu-item">
                <span class="badge badge-green">Registrasi</span>
                <h3>Daftar Pelatihan</h3>
                <p>Melakukan pendaftaran ke sesi pelatihan dan memonitor status pending, approve, atau reject.</p>
            </div>

            <div class="menu-item">
                <span class="badge badge-purple">Materi</span>
                <h3>Akses Materi</h3>
                <p>Membuka materi dari Google Drive, YouTube, atau tautan lain yang disediakan admin.</p>
            </div>

            <div class="menu-item">
                <span class="badge badge-orange">Quiz</span>
                <h3>Ikuti Quiz</h3>
                <p>Mengerjakan quiz essay dan multiple choice saat modul evaluasi sudah diaktifkan.</p>
            </div>

            <div class="menu-item">
                <span class="badge badge-red">Hasil</span>
                <h3>Hasil Quiz</h3>
                <p>Melihat hasil penilaian, skor, dan evaluasi peserta pada setiap pelatihan.</p>
            </div>

            <div class="menu-item">
                <span class="badge badge-blue">Sertifikat</span>
                <h3>Sertifikat</h3>
                <p>Mengunduh sertifikat pelatihan otomatis setelah semua syarat penyelesaian terpenuhi.</p>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Status Pengembangan Portal</div>
                <div class="section-subtitle">Progress implementasi modul user</div>
            </div>
            <span class="badge badge-purple">Update</span>
        </div>

        <div style="margin-bottom:18px;">
            <div class="card-title">Login & Portal Shell</div>
            <div class="progress"><div class="progress-bar progress-green" style="width:100%"></div></div>
        </div>

        <div style="margin-bottom:18px;">
            <div class="card-title">Training & Registrasi</div>
            <div class="progress"><div class="progress-bar progress-blue" style="width:75%"></div></div>
        </div>

        <div style="margin-bottom:18px;">
            <div class="card-title">Materi</div>
            <div class="progress"><div class="progress-bar progress-purple" style="width:70%"></div></div>
        </div>

        <div>
            <div class="card-title">Quiz & Sertifikat</div>
            <div class="progress"><div class="progress-bar progress-orange" style="width:20%"></div></div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/user/home.blade.php ENDPATH**/ ?>