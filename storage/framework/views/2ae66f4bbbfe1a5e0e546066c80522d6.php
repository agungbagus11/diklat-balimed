<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal User - DIKLAT RS BALIMED DENPASAR</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand-box">
            <img src="https://rsbalimed.com/wp-content/uploads/2022/09/logo-balimed-hospital.png" class="brand-logo" alt="Logo">
            <div>
                <div class="brand-title">DIKLAT RS BALIMED</div>
                <div class="brand-subtitle">Denpasar · Portal 2025/2026</div>
            </div>
        </div>

        <div class="user-card">
            <div class="user-name"><?php echo e(auth()->user()->name ?? 'User Diklat'); ?></div>
            <div class="user-meta"><?php echo e(auth()->user()->employee_id ?? '-'); ?></div>
            <div class="user-meta">Role: <?php echo e(auth()->user()->role_label ?? 'user'); ?></div>
        </div>

        <div class="sidebar-title">Menu Utama</div>
        <div class="nav-list">
            <button type="button" class="nav-link active" data-url="<?php echo e(url('/user/home')); ?>" onclick="loadFrame(this)">
                Dashboard
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/trainings')); ?>" onclick="loadFrame(this)">
                Internal Training
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/trainings')); ?>" onclick="loadFrame(this)">
                Webinar
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/trainings')); ?>" onclick="loadFrame(this)">
                External Training
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/trainings')); ?>" onclick="loadFrame(this)">
                Jadwal Diklat
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/my-registrations')); ?>" onclick="loadFrame(this)">
                Registrasi
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/materials')); ?>" onclick="loadFrame(this)">
                Materi
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/home')); ?>" onclick="loadFrame(this)">
                Kuis
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/home')); ?>" onclick="loadFrame(this)">
                Hasil Kuis
            </button>
            <button type="button" class="nav-link" data-url="<?php echo e(url('/user/home')); ?>" onclick="loadFrame(this)">
                Sertifikat
            </button>
        </div>

        <?php if(auth()->user() && (
            (auth()->user()->role_label ?? '') === 'super_admin' ||
            (auth()->user()->role_label ?? '') === 'admin_diklat' ||
            auth()->user()->hasAnyRole(['super_admin', 'admin_diklat'])
        )): ?>
            <div class="sidebar-title">Menu Admin</div>
            <div class="nav-list">
                <a href="<?php echo e(url('/admin/dashboard')); ?>" class="nav-link">
                    Admin Dashboard
                </a>
                <button type="button" class="nav-link" data-url="<?php echo e(url('/admin/trainings')); ?>" onclick="loadFrame(this)">
                    Manajemen Training
                </button>
                <button type="button" class="nav-link" data-url="<?php echo e(url('/admin/registrations')); ?>" onclick="loadFrame(this)">
                    Registrasi Peserta
                </button>
            </div>
        <?php endif; ?>

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
                <div class="topbar-title">DIKLAT RS BALIMED DENPASAR</div>
                <div class="topbar-subtitle">Rumah aplikasi pelatihan, registrasi, materi, quiz, dan sertifikat</div>
            </div>
            <div class="topbar-user"><?php echo e(auth()->user()->name ?? 'User'); ?></div>
        </div>

        <div class="hero">
            <h1>Welcome back, <?php echo e(auth()->user()->name ?? 'Peserta'); ?> 👋</h1>
            <p>
                Selamat datang di portal DIKLAT RS BALIMED DENPASAR.
                Semua layanan pelatihan terintegrasi di sini: internal training, webinar, external training,
                registrasi peserta, materi pembelajaran, quiz, hasil evaluasi, dan sertifikat.
            </p>
        </div>

        <div class="portal-frame-card">
            <iframe
                id="mainFrame"
                src="<?php echo e(url('/user/home')); ?>"
                class="portal-frame"
                title="Portal User Frame">
            </iframe>
        </div>
    </main>
</div>

<script>
function loadFrame(button) {
    const url = button.getAttribute('data-url');
    const frame = document.getElementById('mainFrame');
    if (frame && url) {
        frame.src = url;
    }

    document.querySelectorAll('.nav-list .nav-link').forEach(el => {
        if (el.tagName === 'BUTTON') {
            el.classList.remove('active');
        }
    });

    if (button.tagName === 'BUTTON') {
        button.classList.add('active');
    }
}
</script>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/portal/index.blade.php ENDPATH**/ ?>