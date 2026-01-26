<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PengumumanController extends Controller
{
    private function getAnnouncementDate()
    {
        return Carbon::create(2026, 2, 20, 0, 1, 0, 'Asia/Jakarta');
    }

    public function index()
    {
        if (now()->lessThan($this->getAnnouncementDate())) {
            return Inertia::render('Pengumuman/Pending');
        }

        return Inertia::render('Pengumuman/Index');
    }

    public function show(Request $request)
    {
        if (now()->lessThan($this->getAnnouncementDate())) {
            return redirect()->route('pengumuman.index');
        }

        $request->validate([
            'nim' => 'required|string|max:20'
        ]);

        $user = User::where('nim', $request->nim)->first();

        $result = null;
        $error = null;

        if (!$user) {
            $error = 'NIM tidak ditemukan. Pastikan kamu sudah terdaftar.';
        } else {
            $applicant = Applicant::where('user_id', $user->id)->first();

            if (!$applicant) {
                $error = 'Akun ditemukan, tapi data pendaftaran tidak ada.';
            } else {
                $result = [
                    'name' => $user->name,
                    'nim' => $user->nim,
                    'status' => $applicant->status,
                    'accepted_division' => $applicant->status === 'diterima' ? $applicant->accepted_division : null,
                ];
            }
        }

        if ($error) {
            return back()->withErrors(['nim' => $error]);
        }

        return Inertia::render('Pengumuman/Index', [
            'result' => $result
        ]);
    }
}
