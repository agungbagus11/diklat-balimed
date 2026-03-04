<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Peserta</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body class="frame-body">
    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Registrasi Peserta</div>
                <div class="section-subtitle">Kelola pendaftaran peserta training, approve, reject, atau hapus agar bisa daftar ulang</div>
            </div>
            <span class="badge badge-green">Admin Panel</span>
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

    <div class="grid grid-4">
        <div class="card card-accent-blue card-soft-blue">
            <div class="card-title">Total Registrasi</div>
            <div class="card-value"><?php echo e($registrations->total()); ?></div>
            <div class="card-note">Semua data hasil filter</div>
        </div>

        <div class="card card-accent-orange card-soft-orange">
            <div class="card-title">Pending</div>
            <div class="card-value"><?php echo e($summaryPending); ?></div>
            <div class="card-note">Menunggu persetujuan admin</div>
        </div>

        <div class="card card-accent-green card-soft-green">
            <div class="card-title">Approved</div>
            <div class="card-value"><?php echo e($summaryApproved); ?></div>
            <div class="card-note">Sudah disetujui</div>
        </div>

        <div class="card card-accent-red card-soft-red">
            <div class="card-title">Rejected</div>
            <div class="card-value"><?php echo e($summaryRejected); ?></div>
            <div class="card-note">Ditolak admin</div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Filter Registrasi</div>
                <div class="section-subtitle">Saring berdasarkan training, sesi, atau status</div>
            </div>
        </div>

        <form method="GET" action="<?php echo e(route('admin.registrations.index')); ?>" class="admin-form">
            <div class="form-grid form-grid-4">
                <div class="form-group">
                    <label class="form-label">Training</label>
                    <select name="training_id" class="form-control">
                        <option value="">Semua training</option>
                        <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($training->id); ?>" <?php echo e(request('training_id') == $training->id ? 'selected' : ''); ?>>
                                <?php echo e($training->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Sesi</label>
                    <select name="session_id" class="form-control">
                        <option value="">Semua sesi</option>
                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($session->id); ?>" <?php echo e(request('session_id') == $session->id ? 'selected' : ''); ?>>
                                <?php echo e($session->session_name); ?> - <?php echo e($session->training->title ?? '-'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua status</option>
                        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="approved" <?php echo e(request('status') === 'approved' ? 'selected' : ''); ?>>Approved</option>
                        <option value="rejected" <?php echo e(request('status') === 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                        <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-blue">Filter</button>
                        <a href="<?php echo e(route('admin.registrations.index')); ?>" class="btn btn-light">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="section-card">
        <div class="section-header">
            <div>
                <div class="section-title">Daftar Peserta Terdaftar</div>
                <div class="section-subtitle">Approve, reject, atau hapus data registrasi peserta</div>
            </div>
        </div>

        <div class="table-wrap">
            <table class="table registration-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Peserta</th>
                        <th>Training</th>
                        <th>Sesi</th>
                        <th>Status</th>
                        <th>Waktu Daftar</th>
                        <th width="260">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($registrations->firstItem() + $index); ?></td>

                            <td>
                                <div class="cell-title"><?php echo e($registration->user->name ?? '-'); ?></div>
                                <div class="cell-sub"><?php echo e($registration->user->employee_id ?? '-'); ?></div>
                                <div class="cell-sub"><?php echo e($registration->user->email ?? '-'); ?></div>
                            </td>

                            <td>
                                <div class="cell-title"><?php echo e($registration->training->title ?? '-'); ?></div>
                                <div class="cell-sub"><?php echo e($registration->training->category->name ?? '-'); ?></div>
                            </td>

                            <td>
                                <div class="cell-title"><?php echo e($registration->session->session_name ?? '-'); ?></div>
                                <div class="cell-sub">
                                    <?php echo e($registration->session && $registration->session->session_date ? \Carbon\Carbon::parse($registration->session->session_date)->format('d M Y') : '-'); ?>

                                </div>
                                <div class="cell-sub">
                                    <?php echo e($registration->session->start_time ?? '-'); ?> - <?php echo e($registration->session->end_time ?? '-'); ?>

                                </div>
                            </td>

                            <td>
                                <?php if($registration->status === 'pending'): ?>
                                    <span class="badge badge-orange">Pending</span>
                                <?php elseif($registration->status === 'approved'): ?>
                                    <span class="badge badge-green">Approved</span>
                                <?php elseif($registration->status === 'rejected'): ?>
                                    <span class="badge badge-red">Rejected</span>
                                <?php elseif($registration->status === 'cancelled'): ?>
                                    <span class="badge badge-purple">Cancelled</span>
                                <?php else: ?>
                                    <span class="badge badge-blue"><?php echo e(ucfirst($registration->status ?? '-')); ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="cell-title">
                                    <?php if(!empty($registration->registered_at)): ?>
                                        <?php echo e(\Carbon\Carbon::parse($registration->registered_at)->format('d M Y H:i')); ?>

                                    <?php elseif(!empty($registration->created_at)): ?>
                                        <?php echo e($registration->created_at->format('d M Y H:i')); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="action-stack">
                                    <?php if($registration->status !== 'approved'): ?>
                                        <form method="POST" action="<?php echo e(route('admin.registrations.approve', $registration->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-green btn-sm">Approve</button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if($registration->status !== 'rejected'): ?>
                                        <form method="POST" action="<?php echo e(route('admin.registrations.reject', $registration->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-orange btn-sm">Reject</button>
                                        </form>
                                    <?php endif; ?>

                                    <form method="POST" action="<?php echo e(route('admin.registrations.destroy', $registration->id)); ?>"
                                          onsubmit="return confirm('Hapus registrasi ini? Peserta akan bisa daftar ulang.')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-red btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7">
                                <div class="empty-box" style="margin:16px;">
                                    Belum ada data registrasi peserta.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($registrations->hasPages()): ?>
            <div class="pagination-wrap">
                <?php echo e($registrations->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/admin/registrations/index.blade.php ENDPATH**/ ?>