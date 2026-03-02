<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Training</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-slate-100 min-h-screen p-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Training</h1>
            <p class="text-slate-500 mt-2">Kelola training dan sesi training.</p>
        </div>
        <a href="<?php echo e(route('admin.trainings.create')); ?>"
           class="px-5 py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
            + Tambah Training
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="space-y-6">
        <?php $__empty_1 = true; $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 mb-3">
                            <?php echo e($training->category->name ?? '-'); ?>

                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-800"><?php echo e($training->title); ?></h2>
                        <p class="text-sm text-slate-500 mt-1">Kode: <?php echo e($training->code); ?></p>
                        <div class="mt-3 text-sm text-slate-600 space-y-1">
                            <p><strong>Penyelenggara:</strong> <?php echo e($training->organizer ?: '-'); ?></p>
                            <p><strong>Lokasi:</strong> <?php echo e($training->location ?: '-'); ?></p>
                            <p><strong>Metode:</strong> <?php echo e(ucfirst($training->method)); ?></p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-2 rounded-xl text-sm font-bold <?php echo e($training->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-700'); ?>">
                            <?php echo e($training->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>

                        <a href="<?php echo e(route('admin.trainings.edit', $training->id)); ?>"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <form method="POST" action="<?php echo e(route('admin.trainings.toggle', $training->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">
                                Toggle
                            </button>
                        </form>

                        <form method="POST" action="<?php echo e(route('admin.trainings.destroy', $training->id)); ?>"
                              onsubmit="return confirm('Hapus training ini beserta semua sesi dan registrasi terkait?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>

                        <a href="<?php echo e(route('admin.sessions.create', $training->id)); ?>"
                           class="px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            + Tambah Sesi
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Daftar Sesi</h3>

                    <div class="space-y-3">
                        <?php $__empty_2 = true; $__currentLoopData = $training->sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex flex-wrap items-start justify-between gap-4">
                                    <div>
                                        <p class="font-bold text-slate-800"><?php echo e($session->session_name); ?></p>
                                        <p class="text-sm text-slate-500">
                                            <?php echo e($session->day_name); ?> • <?php echo e(optional($session->session_date)->format('d M Y')); ?>

                                        </p>
                                        <p class="text-sm text-slate-500">
                                            <?php echo e($session->start_time); ?> - <?php echo e($session->end_time); ?>

                                        </p>
                                        <p class="text-sm text-slate-500">
                                            Kuota: <?php echo e($session->quota); ?>

                                        </p>
                                        <p class="text-sm text-slate-500 break-all">
                                            Materi: <?php echo e($session->material_link ?: '-'); ?>

                                        </p>
                                        <p class="text-sm text-slate-500 break-all">
                                            Link Diklat: <?php echo e($session->diklat_link ?: '-'); ?>

                                        </p>
                                    </div>

                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-2 rounded-xl text-sm font-bold <?php echo e($session->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-700'); ?>">
                                            <?php echo e($session->is_active ? 'Aktif' : 'Nonaktif'); ?>

                                        </span>

                                        <a href="<?php echo e(route('admin.sessions.edit', $session->id)); ?>"
                                           class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                                            Edit
                                        </a>

                                        <form method="POST" action="<?php echo e(route('admin.sessions.toggle', $session->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">
                                                Toggle
                                            </button>
                                        </form>

                                        <form method="POST" action="<?php echo e(route('admin.sessions.destroy', $session->id)); ?>"
                                              onsubmit="return confirm('Hapus sesi ini?')">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                            <div class="rounded-2xl border border-dashed border-slate-300 p-4 text-slate-500">
                                Belum ada sesi untuk training ini.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-8 text-center text-slate-500">
                Belum ada data training.
            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/admin/trainings/index.blade.php ENDPATH**/ ?>