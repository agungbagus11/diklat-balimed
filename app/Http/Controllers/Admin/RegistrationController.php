<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Training;
use App\Models\TrainingSession;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::orderBy('title')->get();

        $sessions = TrainingSession::with('training')
            ->orderByDesc('session_date')
            ->orderByDesc('id')
            ->get();

        // Base query untuk summary
        $baseQuery = Registration::query();

        if ($request->filled('training_id')) {
            $baseQuery->where('training_id', $request->training_id);
        }

        if ($request->filled('session_id')) {
            $baseQuery->where('training_session_id', $request->session_id);
        }

        if ($request->filled('status')) {
            $baseQuery->where('status', $request->status);
        }

        $summaryPending = (clone $baseQuery)->where('status', 'pending')->count();
        $summaryApproved = (clone $baseQuery)->where('status', 'approved')->count();
        $summaryRejected = (clone $baseQuery)->where('status', 'rejected')->count();

        // Query utama tabel
        $query = Registration::with([
            'user',
            'training.category',
            'session',
        ])->orderByDesc('id');

        if ($request->filled('training_id')) {
            $query->where('training_id', $request->training_id);
        }

        if ($request->filled('session_id')) {
            $query->where('training_session_id', $request->session_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $registrations = $query->paginate(15)->withQueryString();

        return view('admin.registrations.index', compact(
            'registrations',
            'trainings',
            'sessions',
            'summaryPending',
            'summaryApproved',
            'summaryRejected'
        ));
    }

    public function approve($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = 'approved';
        $registration->save();

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', 'Registrasi peserta berhasil di-approve.');
    }

    public function reject($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = 'rejected';
        $registration->save();

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', 'Registrasi peserta berhasil di-reject.');
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', 'Registrasi peserta berhasil dihapus. Peserta bisa daftar ulang.');
    }
}