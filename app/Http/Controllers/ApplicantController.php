<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplicantController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $applicant = Applicant::where('user_id', $user->id)->select([
            'id',
            'user_id',
            'major',
            'batch',
            'divisi_satu',
            'divisi_dua',
            'alasan_utama',
            'alasan_satu',
            'alasan_dua',
            'path_tugas_satu',
            'path_tugas_dua',
            'path_tiktok',
            'path_instagram',
            'path_pamflet',
            'path_twibbon',
            'created_at'
        ])->first();

        return Inertia::render('Dashboard', [
            'applicant' => $applicant,
        ]);
    }

    public function store(Request $request)
    {
        if (now()->greaterThan(Carbon::parse(config('app.oprec_deadline')))) {
            return redirect()->back()->withErrors(['msg' => 'Maaf waktu pengumpulan tugas sudah selesai.']);
        }

        $user = Auth::user();

        // cek sudah daftar atau belom
        if (Applicant::where('user_id', $user->id)->exists()) {
            return redirect()->back()->withErrors(['msg' => 'Kamu sudah mendaftar, tidak bisa submit ulang.']);
        }

        $validated = $request->validate([
            'major' => 'required|in:si,sk,ti,ka,mi,tk',
            'batch' => 'required|in:2024,2025',
            'divisi_satu' => 'required|in:hrd,pr,mulmed,arrait,scrabble,newscasting,debate,toastmaster',
            'divisi_dua' => 'nullable|in:hrd,pr,mulmed,arrait,scrabble,newscasting,debate,toastmaster',
            'alasan_utama' => 'required|string|min:3|max:10000',
            'alasan_satu' => 'required|string|min:3|max:10000',
            'alasan_dua' => 'nullable|string|max:10000',
            'file_tugas_satu' => 'required|file|mimes:pdf,zip,rar|max:5120',
            'file_tugas_dua' => 'nullable|file|mimes:pdf,zip,rar|max:5120',

            'file_tiktok' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file_instagram' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file_pamflet' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file_twibbon' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->divisi_satu === $request->divisi_dua) {
            return back()->withErrors([
                'divisi_dua' => 'Pilihan divisi tidak boleh sama'
            ]);
        }

        $pathSatu = $request->file('file_tugas_satu')->store('tugas_oprec', 'public');

        $pathTiktok = $request->file('file_tiktok')->store('tugas_screenshoot', 'public');
        $pathInstagram = $request->file('file_instagram')->store('tugas_screenshoot', 'public');
        $pathPamflet = $request->file('file_pamflet')->store('tugas_screenshoot', 'public');
        $pathTwibbon = $request->file('file_twibbon')->store('tugas_screenshoot', 'public');

        $pathDua = null;
        if ($request->hasFile('file_tugas_dua')) {
            $pathDua = $request->file('file_tugas_dua')->store('tugas_oprec', 'public');
        }

        Applicant::create([
            'user_id' => $user->id,
            'major' => $validated['major'],
            'batch' => $validated['batch'],

            'divisi_satu' => $validated['divisi_satu'],
            'divisi_dua' => $validated['divisi_dua'] ?? null,
            'alasan_utama' => $validated['alasan_utama'],
            'alasan_satu' => $validated['alasan_satu'],
            'alasan_dua' => $validated['alasan_dua'] ?? null,
            'path_tugas_satu' => $pathSatu,
            'path_tugas_dua' => $pathDua,

            'path_tiktok' => $pathTiktok,
            'path_instagram' => $pathInstagram,
            'path_pamflet' => $pathPamflet,
            'path_twibbon' => $pathTwibbon,

            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('message', 'Pendaftaran berhasil dikirim!');
    }
}
