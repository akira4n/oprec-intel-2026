<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'status',
        'accepted_division',
        'score_1',
        'notes_1',
        'score_2',
        'notes_2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
