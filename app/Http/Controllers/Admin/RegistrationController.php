<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Training;
use App\Models\TrainingSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $trainingId = $request->get('training_id');
        $sessionId = $request->get('session_id');
        $status = $request->get('status');

        $query = Registration::with(['user', 'training.category', 'session'])
            ->latest();

        if (!empty($trainingId)) {
            $query->where('training_id', $trainingId);
        }

        if (!empty($sessionId)) {
            $query->where('training_session_id', $sessionId);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $registrations = $query->get();

        $trainings = Training::with('category')->orderBy('title')->get();
        $sessions = TrainingSession::with('training')->orderByDesc('session_date')->get();

        return view('admin.registrations.index', compact(
            'registrations',
            'trainings',
            'sessions',
            'trainingId',
            'sessionId',
            'status'
        ));
    }

    public function approve(int $id): RedirectResponse
    {
        $registration = Registration::with('session')->findOrFail($id);

        if (!in_array($registration->status, ['pending', 'rejected'])) {
            return back()->with('error', 'Registrasi ini tidak bisa di-approve.');
        }

        $usedQuota = Registration::where('training_session_id', $registration->training_session_id)
            ->whereIn('status', ['pending', 'approved'])
            ->where('id', '!=', $registration->id)
            ->count();

        if ($usedQuota >= ($registration->session->quota ?? 0)) {
            return back()->with('error', 'Kuota sesi sudah penuh.');
        }

        $registration->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'notes' => 'Disetujui admin',
        ]);

        return back()->with('success', 'Peserta berhasil di-approve.');
    }

    public function reject(int $id): RedirectResponse
    {
        $registration = Registration::findOrFail($id);

        if (!in_array($registration->status, ['pending', 'approved'])) {
            return back()->with('error', 'Registrasi ini tidak bisa di-reject.');
        }

        $registration->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'notes' => 'Ditolak admin',
        ]);

        return back()->with('success', 'Registrasi berhasil ditolak.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return back()->with('success', 'Registrasi berhasil dihapus. User bisa daftar ulang.');
    }
}