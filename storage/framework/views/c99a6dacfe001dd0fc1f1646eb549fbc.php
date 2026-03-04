<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand-box">
            <img src="https://rsbalimed.com/wp-content/uploads/2022/09/logo-balimed-hospital.png" class="brand-logo" alt="Logo">
            <div>
                <div class="brand-title">DIKLAT RS BALIMED</div>
                <div class="brand-subtitle">Portal 2025/2026</div>
            </div>
        </div>

        <div class="user-card">
            <div class="user-name"><?php echo e(auth()->user()->name ?? 'Administrator'); ?></div>
            <div class="user-meta"><?php echo e(auth()->user()->employee_id ?? '-'); ?></div>
            <div class="user-meta">Role: <?php echo e(auth()->user()->role_label ?? 'admin'); ?></div>
        </div>

        <div class="sidebar-title">Menu Utama</div>
        <div class="nav-list">
            <a href="<?php echo e(url('/admin/dashboard')); ?>" class="nav-link active">Dashboard</a>
            <a href="<?php echo e(url('/admin/trainings')); ?>" class="nav-link">Manajemen Training</a>
            <a href="<?php echo e(url('/admin/registrations')); ?>" class="nav-link">Registrasi Peserta</a>
            <a href="<?php echo e(url('/portal')); ?>" class="nav-link">User Portal</a>
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title">Admin Panel — DIKLAT RS BALIMED DENPASAR</div>
                <div class="topbar-subtitle">Dashboard administrasi diklat dengan tampilan modern tanpa Tailwind</div>
            </div>
            <div class="topbar-user"><?php echo e(auth()->user()->name ?? 'Admin'); ?></div>
        </div>

        <div class="hero">
            <h1>Welcome back, <?php echo e(auth()->user()->name ?? 'Administrator'); ?> 👋</h1>
            <p>
                Kelola training, materi, peserta, registrasi, kuis, dan sertifikat
                dalam satu rumah aplikasi yang terintegrasi.
            </p>
        </div>

        <div class="grid grid-4">
            <div class="card card-accent-blue card-soft-blue">
                <div class="card-title">Total Karyawan</div>
                <div class="card-value"><?php echo e(\App\Models\Employee::count()); ?></div>
                <div class="card-note">Master data karyawan aktif</div>
            </div>

            <div class="card card-accent-green card-soft-green">
                <div class="card-title">Total Users</div>
                <div class="card-value"><?php echo e(\App\Models\User::count()); ?></div>
                <div class="card-note">Akun login sistem</div>
            </div>

            <div class="card card-accent-purple card-soft-purple">
                <div class="card-title">Total Training</div>
                <div class="card-value"><?php echo e(\App\Models\Training::count()); ?></div>
                <div class="card-note">Internal, webinar, external</div>
            </div>

            <div class="card card-accent-orange card-soft-orange">
                <div class="card-title">Total Materi</div>
                <div class="card-value"><?php echo e(\App\Models\Material::count()); ?></div>
                <div class="card-note">Google Drive, YouTube, URL</div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-header">
                <div>
                    <div class="section-title">Status Pengembangan</div>
                    <div class="section-subtitle">Progress pembangunan modul aplikasi diklat</div>
                </div>
                <span class="badge badge-blue">Phase 1</span>
            </div>

            <div style="margin-bottom:18px;">
                <div class="card-title">Fondasi Login & Role</div>
                <div class="progress"><div class="progress-bar progress-green" style="width:100%"></div></div>
            </div>

            <div style="margin-bottom:18px;">
                <div class="card-title">Portal Shell</div>
                <div class="progress"><div class="progress-bar progress-blue" style="width:85%"></div></div>
            </div>

            <div style="margin-bottom:18px;">
                <div class="card-title">Training & Registrasi</div>
                <div class="progress"><div class="progress-bar progress-purple" style="width:65%"></div></div>
            </div>

            <div>
                <div class="card-title">Quiz & Sertifikat</div>
                <div class="progress"><div class="progress-bar progress-orange" style="width:20%"></div></div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-header">
                <div>
                    <div class="section-title">Menu Admin Utama</div>
                    <div class="section-subtitle">Akses cepat ke modul inti</div>
                </div>
            </div>

            <div class="menu-grid">
                <a href="<?php echo e(url('/admin/trainings')); ?>" class="menu-item">
                    <span class="badge badge-blue">Training</span>
                    <h3>Manajemen Training</h3>
                    <p>Kelola training, sesi, jadwal, kuota, link materi, dan link diklat.</p>
                </a>

                <a href="<?php echo e(url('/admin/registrations')); ?>" class="menu-item">
                    <span class="badge badge-green">Registrasi</span>
                    <h3>Registrasi Peserta</h3>
                    <p>Approve, reject, dan hapus peserta agar bisa daftar ulang.</p>
                </a>

                <div class="menu-item">
                    <span class="badge badge-purple">Materi</span>
                    <h3>Materi Diklat</h3>
                    <p>Kelola konten pembelajaran dari Google Drive, YouTube, atau URL lain.</p>
                </div>

                <div class="menu-item">
                    <span class="badge badge-orange">Quiz</span>
                    <h3>Bank Soal & Quiz</h3>
                    <p>Essay dan multiple choice untuk evaluasi peserta diklat.</p>
                </div>

                <div class="menu-item">
                    <span class="badge badge-red">Sertifikat</span>
                    <h3>Sertifikat Otomatis</h3>
                    <p>Penerbitan sertifikat otomatis berbasis training dan hasil evaluasi.</p>
                </div>

                <div class="menu-item">
                    <span class="badge badge-blue">Report</span>
                    <h3>Laporan & Statistik</h3>
                    <p>Rekap training, peserta, quiz, aktivitas materi, dan capaian diklat.</p>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>