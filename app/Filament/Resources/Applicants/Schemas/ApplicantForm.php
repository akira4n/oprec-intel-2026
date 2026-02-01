<?php

namespace App\Filament\Resources\Applicants\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle; // Tambahkan ini
use Filament\Schemas\Components\Grid; // Namespace v5 untuk Grid
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ApplicantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Recruitment Detail')
                ->tabs([
                    // =================================================
                    // TAB 1: IDENTITAS (DIKUNCI / READ ONLY)
                    // =================================================
                    Tabs\Tab::make('Identitas & Motivasi')
                        ->icon(Heroicon::OutlinedUser)
                        ->disabled()
                        ->schema([
                            Section::make('Data Mahasiswa')
                                ->schema([
                                    Placeholder::make('nama')
                                        ->label('Nama Lengkap')
                                        ->content(fn ($record) => $record?->user->name ?? '-'),
                                    Select::make('major')
                                        ->options(self::getMajors())
                                        ->label('Jurusan'),
                                    Select::make('batch')
                                        ->options(['2024' => '2024', '2025' => '2025', '2026' => '2026'])
                                        ->label('Angkatan'),
                                ])->columns(3),

                            Section::make('Motivasi & Komitmen') // Saya update judulnya dikit biar pas
                                ->schema([
                                    Textarea::make('alasan_utama')
                                        ->label('Mengapa ingin bergabung dengan INTEL?')
                                        ->rows(3),

                                    // FIELD BARU MASUK DISINI
                                    Textarea::make('capaian')
                                        ->label('Capaian Terbesar')
                                        ->required()
                                        ->columnSpanFull()
                                        ->disabled(),

                                    Grid::make(2)
                                        ->schema([
                                            Toggle::make('org_sebelum')
                                                ->label('Pernah Organisasi?')
                                                ->inline(false)
                                                ->disabled(),

                                            Toggle::make('komitmen_tanggungjawab')
                                                ->label('Siap Berkomitmen?')
                                                ->required()
                                                ->inline(false)
                                                ->disabled(),
                                        ]),
                                ]),
                        ]),

                    // =================================================
                    // TAB 2: PILIHAN DIVISI (DIKUNCI / READ ONLY)
                    // =================================================
                    Tabs\Tab::make('Pilihan Divisi')
                        ->icon(Heroicon::OutlinedRectangleGroup)
                        ->disabled()
                        ->schema([
                            Section::make('Pilihan Utama')
                                ->schema([
                                    Select::make('divisi_satu')
                                        ->options(self::getDivisions())
                                        ->label('Divisi Pilihan 1'),
                                    Textarea::make('alasan_satu')
                                        ->label('Alasan memilih Divisi 1')
                                        ->rows(3),
                                ])->columns(2),
                            Section::make('Pilihan Cadangan')
                                ->schema([
                                    Select::make('divisi_dua')
                                        ->options(self::getDivisions())->label('Divisi Pilihan 2'),
                                    Textarea::make('alasan_dua')
                                        ->label('Alasan memilih Divisi 2')->rows(3),
                                ])->columns(2),
                        ]),

                    // ... (TAB 3, 4, 5 tetap sama seperti kode kamu sebelumnya) ...

                    Tabs\Tab::make('Berkas & Tugas')
                        ->icon(Heroicon::OutlinedDocumentCheck)
                        ->disabled()
                        ->schema([
                            Section::make('File Tugas Pendaftaran')
                                ->columns(2)
                                ->schema([
                                    Placeholder::make('path_tugas_satu')->label('Tugas Divisi 1')
                                        ->content(fn ($record) => self::downloadButton($record?->path_tugas_satu)),
                                    Placeholder::make('path_tugas_dua')->label('Tugas Divisi 2')
                                        ->content(fn ($record) => self::downloadButton($record?->path_tugas_dua)),
                                ]),
                            Section::make('Bukti Screenshot')
                                ->columns(2)
                                ->schema([
                                    Placeholder::make('path_tiktok')->label('Bukti TikTok')->content(fn ($record) => self::imagePreview($record?->path_tiktok)),
                                    Placeholder::make('path_instagram')->label('Bukti Instagram')->content(fn ($record) => self::imagePreview($record?->path_instagram)),
                                    Placeholder::make('path_pamflet')->label('Bukti Pamflet')->content(fn ($record) => self::imagePreview($record?->path_pamflet)),
                                    Placeholder::make('path_twibbon')->label('Bukti Twibbon')->content(fn ($record) => self::imagePreview($record?->path_twibbon)),
                                ]),
                        ]),

                    Tabs\Tab::make('Evaluasi Interview')
                        ->icon(Heroicon::OutlinedClipboardDocumentList)
                        ->schema([
                            Section::make(fn ($record) => 'Penilaian Divisi 1: '.strtoupper($record->divisi_satu))
                                ->description('Isi penilaian untuk pilihan divisi prioritas utama.')
                                ->icon('heroicon-m-star')
                                ->schema([
                                    TextInput::make('score_1')
                                        ->label('Skor (0-100)')
                                        ->numeric()
                                        ->minValue(0)->maxValue(100)->suffix('Poin'),
                                    Textarea::make('notes_1')
                                        ->label('Catatan Interviewer (Divisi 1)')
                                        ->rows(3),
                                ])->columns(2),

                            Section::make(fn ($record) => 'Penilaian Divisi 2: '.($record->divisi_dua ? strtoupper($record->divisi_dua) : '-'))
                                ->icon('heroicon-m-arrow-path-rounded-square')
                                ->collapsed()
                                ->visible(fn ($record) => ! empty($record->divisi_dua))
                                ->schema([
                                    TextInput::make('score_2')
                                        ->label('Skor (0-100)')
                                        ->numeric()
                                        ->minValue(0)->maxValue(100)->suffix('Poin'),
                                    Textarea::make('notes_2')
                                        ->label('Catatan Interviewer (Divisi 2)')
                                        ->rows(3),
                                ])->columns(2),
                        ]),

                    Tabs\Tab::make('Keputusan Akhir')
                        ->icon(Heroicon::OutlinedCheckBadge)
                        ->schema([
                            Section::make('Hasil Seleksi')
                                ->schema([
                                    Select::make('status')
                                        ->options(['pending' => 'Pending', 'terima' => 'Diterima', 'ditolak' => 'Ditolak'])
                                        ->required()->native(false),
                                    Select::make('accepted_division')
                                        ->label('Diterima di Divisi')
                                        ->options(self::getDivisions())->native(false),
                                ])->columns(2),
                        ]),
                ])->columnSpanFull()->persistTabInQueryString(),
        ]);
    }

    // --- Helper Functions ---
    protected static function downloadButton($path)
    {
        if (! $path) {
            return new HtmlString('<span class="text-gray-400 italic">Tidak ada file</span>');
        }
        $url = Storage::url($path);

        return new HtmlString("<a href='{$url}' target='_blank' class='inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-bold shadow hover:bg-primary-500 transition-colors'>📥 Download Tugas</a>");
    }

    protected static function imagePreview($path)
    {
        if (! $path) {
            return new HtmlString('<span class="text-gray-400 italic">Tidak ada gambar</span>');
        }
        $url = Storage::url($path);

        return new HtmlString("<a href='{$url}' target='_blank'><img src='{$url}' class='h-32 w-auto rounded border shadow-sm hover:scale-105 transition-transform' /></a>");
    }

    protected static function getDivisions(): array
    {
        return ['hrd' => 'HRD', 'pr' => 'Public Relation', 'mulmed' => 'Multimedia', 'arrait' => 'ARRAIT', 'scrabble' => 'Scrabble', 'newscasting' => 'Newscasting', 'debate' => 'Debate', 'toastmaster' => 'Toastmaster', 'videography' => 'Videography'];
    }

    protected static function getMajors(): array
    {
        return ['si' => 'Sistem Informasi', 'sk' => 'Sistem Komputer', 'ti' => 'Teknik Informatika', 'ka' => 'Komputerisasi Akuntansi', 'mi' => 'Manajemen Informatika', 'tk' => 'Teknik Komputer'];
    }
}
