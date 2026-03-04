<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Training</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-slate-50 min-h-screen p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-800">Daftar Training</h1>
        <p class="text-slate-500 mt-2">Internal Training, Webinar, dan External Training yang tersedia.</p>
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

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-3xl shadow border border-slate-200 p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 mb-3">
                            <?php echo e($training->category->name ?? '-'); ?>

                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-800"><?php echo e($training->title); ?></h2>
                        <p class="text-sm text-slate-500 mt-1">Kode: <?php echo e($training->code); ?></p>
                    </div>
                    <div class="text-sm font-semibold px-3 py-1 rounded-full <?php echo e($training->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                        <?php echo e($training->is_active ? 'Aktif' : 'Nonaktif'); ?>

                    </div>
                </div>

                <div class="mt-4 text-slate-600 text-sm space-y-2">
                    <p><strong>Penyelenggara:</strong> <?php echo e($training->organizer ?: '-'); ?></p>
                    <p><strong>Lokasi:</strong> <?php echo e($training->location ?: '-'); ?></p>
                    <p><strong>Metode:</strong> <?php echo e(ucfirst($training->method)); ?></p>
                    <p><strong>Deskripsi:</strong> <?php echo e($training->description ?: '-'); ?></p>
                </div>

                <div class="mt-5">
                    <h3 class="font-bold text-slate-800 mb-3">Sesi Training</h3>

                    <div class="space-y-3">
                        <?php $__empty_2 = true; $__currentLoopData = $training->sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <?php
                                $usedQuota = \App\Models\Registration::where('training_session_id', $session->id)
                                    ->whereIn('status', ['pending', 'approved'])
                                    ->count();

                                $remainingQuota = max(0, $session->quota - $usedQuota);

                                $myRegistration = \App\Models\Registration::where('training_session_id', $session->id)
                                    ->where('user_id', auth()->id())
                                    ->first();
                            ?>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="font-bold text-slate-800"><?php echo e($session->session_name); ?></p>
                                        <p class="text-sm text-slate-500">
                                            <?php echo e($session->day_name); ?> • <?php echo e(optional($session->session_date)->format('d M Y')); ?>

                                        </p>
                                        <p class="text-sm text-slate-500">
                                            <?php echo e($session->start_time); ?> - <?php echo e($session->end_time); ?>

                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-sm text-slate-500">Sisa Kuota</p>
                                        <p class="font-bold <?php echo e($remainingQuota > 0 ? 'text-indigo-600' : 'text-red-600'); ?>">
                                            <?php echo e($remainingQuota); ?>

                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-3 items-center">
                                    <?php if($myRegistration): ?>
                                        <span class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 font-semibold">
                                            Sudah daftar (<?php echo e(ucfirst($myRegistration->status)); ?>)
                                        </span>
                                    <?php elseif($remainingQuota <= 0): ?>
                                        <span class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-semibold">
                                            Kuota Penuh
                                        </span>
                                    <?php else: ?>
                                        <form method="POST" action="<?php echo e(route('user.trainings.register', $session->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                                                Daftar
                                            </button>
                                        </form>
                                    <?php endif; ?>
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
            <div class="col-span-full bg-white rounded-3xl shadow border border-slate-200 p-8 text-center text-slate-500">
                Belum ada data training.
            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/user/trainings/index.blade.php ENDPATH**/ ?>