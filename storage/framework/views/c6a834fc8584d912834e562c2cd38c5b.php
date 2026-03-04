<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Training</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body class="frame-body">
    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Manajemen Training</div>
                <div class="section-subtitle">Kelola training, kategori, sesi, jadwal, kuota, dan link materi</div>
            </div>
            <a href="<?php echo e(route('admin.trainings.create')); ?>" class="btn btn-blue">+ Tambah Training</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert-box alert-success-box">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert-box alert-danger-box">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="training-stack">
        <?php $__empty_1 = true; $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="training-card">
                <div class="training-top">
                    <div>
                        <div class="training-badges">
                            <span class="badge badge-blue"><?php echo e($training->category->name ?? 'Tanpa Kategori'); ?></span>
                            <?php if($training->is_active): ?>
                                <span class="badge badge-green">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-red">Nonaktif</span>
                            <?php endif; ?>
                            <span class="badge badge-purple"><?php echo e(strtoupper($training->method ?? '-')); ?></span>
                        </div>

                        <h2 class="training-title"><?php echo e($training->title); ?></h2>
                        <div class="training-code">Kode: <?php echo e($training->code); ?></div>
                        <p class="training-desc"><?php echo e($training->description ?: 'Belum ada deskripsi training.'); ?></p>
                    </div>

                    <div class="training-actions">
                        <a href="<?php echo e(route('admin.trainings.edit', $training->id)); ?>" class="btn btn-blue">Edit</a>

                        <form method="POST" action="<?php echo e(route('admin.trainings.toggle', $training->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-orange">Toggle</button>
                        </form>

                        <a href="<?php echo e(route('admin.materials.index', $training->id)); ?>" class="btn btn-green">Materi</a>

                        <a href="<?php echo e(route('admin.sessions.create', $training->id)); ?>" class="btn btn-purple">+ Sesi</a>

                        <form method="POST" action="<?php echo e(route('admin.trainings.destroy', $training->id)); ?>" onsubmit="return confirm('Hapus training ini beserta sesi terkait?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-red">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="training-meta-grid">
                    <div class="mini-info">
                        <div class="mini-label">Penyelenggara</div>
                        <div class="mini-value"><?php echo e($training->organizer ?: '-'); ?></div>
                    </div>
                    <div class="mini-info">
                        <div class="mini-label">Lokasi</div>
                        <div class="mini-value"><?php echo e($training->location ?: '-'); ?></div>
                    </div>
                    <div class="mini-info">
                        <div class="mini-label">Total Sesi</div>
                        <div class="mini-value"><?php echo e($training->sessions->count()); ?></div>
                    </div>
                </div>

                <div class="sessions-block">
                    <div class="sessions-title">Daftar Sesi</div>

                    <?php $__empty_2 = true; $__currentLoopData = $training->sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                        <div class="session-item">
                            <div class="session-main">
                                <div>
                                    <div class="session-name"><?php echo e($session->session_name); ?></div>
                                    <div class="session-sub">
                                        <?php echo e($session->day_name ?: '-'); ?> ·
                                        <?php echo e($session->session_date ? \Carbon\Carbon::parse($session->session_date)->format('d M Y') : '-'); ?> ·
                                        <?php echo e($session->start_time ?: '-'); ?> - <?php echo e($session->end_time ?: '-'); ?>

                                    </div>
                                    <div class="session-links">
                                        <span>Kuota: <?php echo e($session->quota); ?></span>
                                        <span>Materi: <?php echo e($session->material_link ?: '-'); ?></span>
                                        <span>Link Diklat: <?php echo e($session->diklat_link ?: '-'); ?></span>
                                    </div>
                                </div>

                                <div class="training-actions">
                                    <?php if($session->is_active): ?>
                                        <span class="badge badge-green">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-red">Nonaktif</span>
                                    <?php endif; ?>

                                    <a href="<?php echo e(route('admin.sessions.edit', $session->id)); ?>" class="btn btn-blue">Edit</a>

                                    <form method="POST" action="<?php echo e(route('admin.sessions.toggle', $session->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-orange">Toggle</button>
                                    </form>

                                    <form method="POST" action="<?php echo e(route('admin.sessions.destroy', $session->id)); ?>" onsubmit="return confirm('Hapus sesi ini?')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-red">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        <div class="empty-box">
                            Belum ada sesi untuk training ini.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="section-card">
                <div class="empty-box">
                    Belum ada data training.
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/admin/trainings/index.blade.php ENDPATH**/ ?>