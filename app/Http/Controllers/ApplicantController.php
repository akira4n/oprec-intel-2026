<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'capaian',
            'org_sebelum',
            'komitmen_tanggungjawab',
            'path_tugas_satu',
            'path_tugas_dua',
            'path_tiktok',
            'path_instagram',
            'path_pamflet',
            'path_twibbon',
            'created_at',
            'interview_location'
        ])->first();

        return Inertia::render('Dashboard', [
            'applicant' => $applicant,
        ]);
    }

    public function store(Request $request)
    {
        if (now()->greaterThan(Carbon::parse(config('app.oprec_deadline')))) {
            return redirect()->back()->withErrors(['msg' => 'Maaf waktu pendaftaran sudah ditutup.']);
        }

        $user = Auth::user();

        if (Applicant::where('user_id', $user->id)->exists()) {
            return redirect()->back()->withErrors(['msg' => 'Kamu sudah mendaftar.']);
        }

        $validated = $request->validate([
            'major' => 'required|in:si,sk,ti,ka,mi,tk',
            'batch' => 'required|in:2024,2025',
            'divisi_satu' => 'required|in:hrd,pr,mulmed,arrait,scrabble,newscasting,debate,toastmaster,videography',
            'divisi_dua' => 'required|in:hrd,pr,mulmed,arrait,scrabble,newscasting,debate,toastmaster,videography',
            'alasan_utama' => 'required|string|min:3|max:10000',
            'alasan_satu' => 'required|string|min:3|max:10000',
            'alasan_dua' => 'required|string|min:3|max:10000',

            'capaian' => 'required|string|min:3|max:10000',
            'org_sebelum' => 'required|boolean',
            'komitmen_tanggungjawab' => 'required|boolean',

            'file_tiktok' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'file_instagram' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'file_pamflet' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'file_twibbon' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->divisi_satu === $request->divisi_dua) {
            return back()->withErrors(['divisi_dua' => 'Division choices must be different.']);
        }

        $pathTiktok = $request->file('file_tiktok')->store('tugas_screenshoot', 'public');
        $pathInstagram = $request->file('file_instagram')->store('tugas_screenshoot', 'public');
        $pathPamflet = $request->file('file_pamflet')->store('tugas_screenshoot', 'public');
        $pathTwibbon = $request->file('file_twibbon')->store('tugas_screenshoot', 'public');

        Applicant::create([
            'user_id' => $user->id,
            'major' => $validated['major'],
            'batch' => $validated['batch'],
            'divisi_satu' => $validated['divisi_satu'],
            'divisi_dua' => $validated['divisi_dua'],
            'alasan_utama' => $validated['alasan_utama'],
            'alasan_satu' => $validated['alasan_satu'],
            'alasan_dua' => $validated['alasan_dua'],

            'capaian' => $validated['capaian'],
            'org_sebelum' => $validated['org_sebelum'],
            'komitmen_tanggungjawab' => $validated['komitmen_tanggungjawab'],

            'path_tiktok' => $pathTiktok,
            'path_instagram' => $pathInstagram,
            'path_pamflet' => $pathPamflet,
            'path_twibbon' => $pathTwibbon,

            'path_tugas_satu' => null,
            'path_tugas_dua' => null,

            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('message', 'Your registration data have been sent! Please continue uploading assignments.');
    }

    public function storeTasks(Request $request)
    {
        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)->firstOrFail();

        if (now()->greaterThan(Carbon::parse(config('app.task_deadline')))) {
            return redirect()->back()->withErrors(['msg' => 'Maaf, batas waktu pengumpulan tugas sudah habis.']);
        }

        $request->validate([
            'file_tugas_satu' => 'required|file|mimes:pdf,zip,rar,doc,docx|max:10240',
            'file_tugas_dua' => 'nullable|file|mimes:pdf,zip,rar,doc,docx|max:10240',
        ]);

        $cleanName = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $user->name));
        $userNim = $user->nim;

        if ($request->hasFile('file_tugas_satu')) {
            $file1 = $request->file('file_tugas_satu');
            $ext1 = $file1->getClientOriginalExtension();
            $divisi1 = strtoupper($applicant->divisi_satu);

            $filename1 = "{$cleanName}_{$userNim}_TUGAS1_{$divisi1}.{$ext1}";
            $pathSatu = $file1->storeAs('tugas_oprec', $filename1, 'public');

            $applicant->path_tugas_satu = $pathSatu;
        }

        if ($request->hasFile('file_tugas_dua')) {
            $file2 = $request->file('file_tugas_dua');
            $ext2 = $file2->getClientOriginalExtension();
            $divisi2 = strtoupper($applicant->divisi_dua);

            $filename2 = "{$cleanName}_{$userNim}_TUGAS2_{$divisi2}.{$ext2}";
            $pathDua = $file2->storeAs('tugas_oprec', $filename2, 'public');

            $applicant->path_tugas_dua = $pathDua;
        }

        $applicant->save();

        return redirect()->route('dashboard')->with('message', 'Task has been sent! Good Luck.');
    }

    public function updateLocation(Request $request)
    {
        if (now()->greaterThan(Carbon::parse(config('app.oprec_deadline')))) {
            return redirect()->back()->withErrors(['msg' => 'Maaf, batas waktu pemilihan lokasi wawancara sudah ditutup.']);
        }

        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'interview_location' => 'required|in:Indralaya,Palembang',
        ]);

        $applicant->update([
            'interview_location' => $request->interview_location
        ]);

        return redirect()->back()->with('message', 'Lokasi wawancara berhasil disimpan! Jangan lupa hadir tepat waktu.');
    }
}
