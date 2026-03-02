<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TrainingController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Admin\TrainingSessionController as AdminTrainingSessionController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\User\MaterialController as UserMaterialController;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if (
        $user->hasAnyRole(['super_admin', 'admin_diklat']) ||
        in_array($user->role_label, ['super_admin', 'admin_diklat'])
    ) {
        return redirect('/admin/dashboard');
    }

    return redirect('/portal');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::view('/portal', 'portal.index')->name('portal');
    Route::view('/user/home', 'user.home')->name('user.home');
});

Route::middleware(['auth', 'admin.only'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/portal', 'portal.index')->name('portal');
    Route::view('/user/home', 'user.home')->name('user.home');
    Route::get('/user/trainings', [TrainingController::class, 'index'])->name('user.trainings.index');
    Route::get('/user/materials', [UserMaterialController::class, 'index'])
        ->name('user.materials.index');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/portal', 'portal.index')->name('portal');
    Route::view('/user/home', 'user.home')->name('user.home');

    Route::get('/user/trainings', [TrainingController::class, 'index'])->name('user.trainings.index');

    Route::post('/user/trainings/register/{sessionId}', [RegistrationController::class, 'store'])
        ->name('user.trainings.register');

    Route::get('/user/my-registrations', [RegistrationController::class, 'myRegistrations'])
        ->name('user.registrations.index');

    Route::post('/user/my-registrations/{id}/cancel', [RegistrationController::class, 'cancel'])
        ->name('user.registrations.cancel');
});

Route::middleware(['auth', 'admin.only'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::get('/admin/registrations', [AdminRegistrationController::class, 'index'])
        ->name('admin.registrations.index');

    Route::post('/admin/registrations/{id}/approve', [AdminRegistrationController::class, 'approve'])
        ->name('admin.registrations.approve');

    Route::post('/admin/registrations/{id}/reject', [AdminRegistrationController::class, 'reject'])
        ->name('admin.registrations.reject');

    Route::post('/admin/registrations/{id}/delete', [AdminRegistrationController::class, 'destroy'])
        ->name('admin.registrations.destroy');
    Route::get('/admin/trainings/{trainingId}/materials', [AdminMaterialController::class, 'index'])
        ->name('admin.materials.index');

    Route::get('/admin/trainings/{trainingId}/materials/create', [AdminMaterialController::class, 'create'])
        ->name('admin.materials.create');

    Route::post('/admin/trainings/{trainingId}/materials/store', [AdminMaterialController::class, 'store'])
        ->name('admin.materials.store');

    Route::get('/admin/materials/{id}/edit', [AdminMaterialController::class, 'edit'])
        ->name('admin.materials.edit');

    Route::post('/admin/materials/{id}/update', [AdminMaterialController::class, 'update'])
        ->name('admin.materials.update');

    Route::post('/admin/materials/{id}/delete', [AdminMaterialController::class, 'destroy'])
        ->name('admin.materials.destroy');

    Route::post('/admin/materials/{id}/toggle', [AdminMaterialController::class, 'toggle'])
        ->name('admin.materials.toggle');
});


Route::get('/admin/trainings', [AdminTrainingController::class, 'index'])->name('admin.trainings.index');
Route::get('/admin/trainings/create', [AdminTrainingController::class, 'create'])->name('admin.trainings.create');
Route::post('/admin/trainings/store', [AdminTrainingController::class, 'store'])->name('admin.trainings.store');
Route::get('/admin/trainings/{id}/edit', [AdminTrainingController::class, 'edit'])->name('admin.trainings.edit');
Route::post('/admin/trainings/{id}/update', [AdminTrainingController::class, 'update'])->name('admin.trainings.update');
Route::post('/admin/trainings/{id}/delete', [AdminTrainingController::class, 'destroy'])->name('admin.trainings.destroy');
Route::post('/admin/trainings/{id}/toggle', [AdminTrainingController::class, 'toggle'])->name('admin.trainings.toggle');

Route::get('/admin/trainings/{trainingId}/sessions/create', [AdminTrainingSessionController::class, 'create'])->name('admin.sessions.create');
Route::post('/admin/trainings/{trainingId}/sessions/store', [AdminTrainingSessionController::class, 'store'])->name('admin.sessions.store');
Route::get('/admin/sessions/{id}/edit', [AdminTrainingSessionController::class, 'edit'])->name('admin.sessions.edit');
Route::post('/admin/sessions/{id}/update', [AdminTrainingSessionController::class, 'update'])->name('admin.sessions.update');
Route::post('/admin/sessions/{id}/delete', [AdminTrainingSessionController::class, 'destroy'])->name('admin.sessions.destroy');
Route::post('/admin/sessions/{id}/toggle', [AdminTrainingSessionController::class, 'toggle'])->name('admin.sessions.toggle');
require __DIR__ . '/auth.php';