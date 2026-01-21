<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplicantController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $applicant = Applicant::where('user_id', $user->id)->first();

        return Inertia::render('Dashboard', [
            'applicant' => $applicant,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (Applicant::where('user_id', $user->id)->exists()) {
            return redirect()->back()->withErrors(['msg' => 'Kamu sudah mendaftar, tidak bisa submit ulang.']);
        }

        $validated = $request->validate([
            'divisi_satu' => 'required|in:hrd,pr,mulmed,arrait,scrabble,newscasting,debate,toastmaster',
            'divisi_dua' => 'nullable|in:hrd,pr,mulmed,arrait,scrabble,newscasting,debate,toastmaster',
            'alasan_utama' => 'required|string|min:20',
            'alasan_satu' => 'required|string|min:20',
            'alasan_dua' => 'nullable|string',
            'file_tugas_satu' => 'required|file|mimes:pdf,zip,rar|max:10240',
            'file_tugas_dua' => 'nullable|file|mimes:pdf,zip,rar|max:10240',
        ]);

        $pathSatu = $request->file('file_tugas_satu')->store('tugas_oprec', 'public');

        $pathDua = null;
        if ($request->hasFile('file_tugas_dua')) {
            $pathDua = $request->file('file_tugas_dua')->store('tugas_oprec', 'public');
        }

        Applicant::create([
            'user_id' => $user->id,
            'divisi_satu' => $validated['divisi_satu'],
            'divisi_dua' => $validated['divisi_dua'] ?? null,
            'alasan_utama' => $validated['alasan_utama'],
            'alasan_satu' => $validated['alasan_satu'],
            'alasan_dua' => $validated['alasan_dua'] ?? null,
            'path_tugas_satu' => $pathSatu,
            'path_tugas_dua' => $pathDua,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('message', 'Pendaftaran berhasil dikirim!');
    }
}
