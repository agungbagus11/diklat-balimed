<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\TrainingSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request, int $sessionId): RedirectResponse
    {
        $user = auth()->user();

        $session = TrainingSession::with('training')->findOrFail($sessionId);

        // sesi aktif?
        if (! $session->is_active) {
            return back()->with('error', 'Sesi training sedang tidak aktif.');
        }

        // training aktif?
        if (! $session->training || ! $session->training->is_active) {
            return back()->with('error', 'Training sedang tidak aktif.');
        }

        // cegah daftar dobel per sesi
        $alreadyRegistered = Registration::where('training_session_id', $session->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'Anda sudah terdaftar pada sesi ini.');
        }

        // optional: cegah 1 user ambil lebih dari 1 sesi dalam 1 training
        $alreadyInSameTraining = Registration::where('training_id', $session->training_id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($alreadyInSameTraining) {
            return back()->with('error', 'Anda sudah terdaftar pada training ini di sesi lain.');
        }

        // cek kuota approved + pending
        $usedQuota = Registration::where('training_session_id', $session->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($usedQuota >= $session->quota) {
            return back()->with('error', 'Kuota sesi sudah penuh.');
        }

        Registration::create([
            'training_id' => $session->training_id,
            'training_session_id' => $session->id,
            'user_id' => $user->id,
            'status' => 'pending',
            'registered_at' => now(),
            'notes' => null,
        ]);

        return back()->with('success', 'Pendaftaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function myRegistrations()
    {
        $registrations = Registration::with(['training.category', 'session'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.registrations.index', compact('registrations'));
    }

    public function cancel(int $id): RedirectResponse
    {
        $registration = Registration::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (! in_array($registration->status, ['pending', 'approved'])) {
            return back()->with('error', 'Registrasi ini tidak bisa dibatalkan.');
        }

        $registration->update([
            'status' => 'cancelled',
            'notes' => 'Dibatalkan oleh user',
        ]);

        return back()->with('success', 'Registrasi berhasil dibatalkan.');
    }
}