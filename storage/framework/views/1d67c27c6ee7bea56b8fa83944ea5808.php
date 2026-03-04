<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Training</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body class="frame-body">
    <div class="form-shell">
        <div class="section-card">
            <div class="section-header">
                <div>
                    <div class="section-title">Edit Training</div>
                    <div class="section-subtitle">Perbarui data training, kategori, metode, dan informasi utama</div>
                </div>
                <a href="<?php echo e(route('admin.trainings.index')); ?>" class="btn btn-light">Kembali</a>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert-box alert-danger-box">
                    Mohon cek kembali form. Masih ada data yang belum valid.
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.trainings.update', $training->id)); ?>" class="admin-form">
                <?php echo csrf_field(); ?>

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Kategori Training</label>
                        <select name="training_category_id" class="form-control">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('training_category_id', $training->training_category_id) == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kode Training</label>
                        <input type="text" name="code" value="<?php echo e(old('code', $training->code)); ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Training</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $training->title)); ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control"><?php echo e(old('description', $training->description)); ?></textarea>
                </div>

                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">Penyelenggara</label>
                        <input type="text" name="organizer" value="<?php echo e(old('organizer', $training->organizer)); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="location" value="<?php echo e(old('location', $training->location)); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode</label>
                        <select name="method" class="form-control">
                            <option value="offline" <?php echo e(old('method', $training->method) === 'offline' ? 'selected' : ''); ?>>Offline</option>
                            <option value="online" <?php echo e(old('method', $training->method) === 'online' ? 'selected' : ''); ?>>Online</option>
                            <option value="hybrid" <?php echo e(old('method', $training->method) === 'hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                        </select>
                    </div>
                </div>

                <div class="check-row">
                    <label class="remember-label">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $training->is_active) ? 'checked' : ''); ?>>
                        <span>Aktifkan training</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-blue">Update Training</button>
                    <a href="<?php echo e(route('admin.trainings.index')); ?>" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\diklat-balimed\resources\views/admin/trainings/edit.blade.php ENDPATH**/ ?>