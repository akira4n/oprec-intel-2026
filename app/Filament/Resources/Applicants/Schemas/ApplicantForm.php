<?php

namespace App\Filament\Resources\Applicants\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
                    // TAB 1: IDENTITAS & ALASAN UTAMA
                    Tabs\Tab::make('Identitas & Motivasi')
                        ->icon(Heroicon::OutlinedUser)
                        ->schema([
                            Section::make('Data Mahasiswa')
                                ->schema([
                                    Placeholder::make('nama')
                                        ->label('Nama Lengkap')
                                        ->content(fn ($record) => $record?->user->name ?? '-'),
                                    Select::make('major')
                                        ->options(self::getMajors())
                                        ->label('Jurusan')
                                        ->required(),
                                    Select::make('batch')
                                        ->options(['2024' => '2024', '2025' => '2025'])
                                        ->label('Angkatan')
                                        ->required(),
                                ])->columns(3),

                            Section::make('Motivasi Bergabung')
                                ->schema([
                                    Textarea::make('alasan_utama')
                                        ->label('Mengapa ingin bergabung dengan INTEL?')
                                        ->rows(4)
                                        ->required(),
                                ]),
                        ]),

                    // TAB 2: PILIHAN DIVISI & ALASAN KHUSUS
                    Tabs\Tab::make('Pilihan Divisi')
                        ->icon(Heroicon::OutlinedRectangleGroup)
                        ->schema([
                            Section::make('Pilihan Utama')
                                ->schema([
                                    Select::make('divisi_satu')
                                        ->options(self::getDivisions())
                                        ->label('Divisi Pilihan 1')
                                        ->required(),
                                    Textarea::make('alasan_satu')
                                        ->label('Alasan memilih Divisi 1')
                                        ->rows(3)
                                        ->required(),
                                ])->columns(2),

                            Section::make('Pilihan Cadangan')
                                ->schema([
                                    Select::make('divisi_dua')
                                        ->options(self::getDivisions())
                                        ->label('Divisi Pilihan 2'),
                                    Textarea::make('alasan_dua')
                                        ->label('Alasan memilih Divisi 2')
                                        ->rows(3),
                                ])->columns(2),
                        ]),

                    // TAB 3: BERKAS & TUGAS (Dengan Tombol Unduh & Preview)
                    Tabs\Tab::make('Berkas & Tugas')
                        ->icon(Heroicon::OutlinedDocumentCheck)
                        ->schema([
                            Section::make('File Tugas Pendaftaran')
                                ->description('File disimpan di folder: tugas_oprec')
                                ->columns(2)
                                ->schema([
                                    Placeholder::make('path_tugas_satu')
                                        ->label('Tugas Utama')
                                        ->content(fn ($record) => self::downloadButton($record?->path_tugas_satu)),

                                    Placeholder::make('path_tugas_dua')
                                        ->label('Tugas Tambahan')
                                        ->content(fn ($record) => self::downloadButton($record?->path_tugas_dua)),
                                ]),

                            Section::make('Bukti Screenshot Sosial Media')
                                ->description('File disimpan di folder: tugas_screenshoot')
                                ->columns(2)
                                ->schema([
                                    Placeholder::make('path_tiktok')->label('Bukti TikTok')->content(fn ($record) => self::imagePreview($record?->path_tiktok)),
                                    Placeholder::make('path_instagram')->label('Bukti Instagram')->content(fn ($record) => self::imagePreview($record?->path_instagram)),
                                    Placeholder::make('path_pamflet')->label('Bukti Pamflet')->content(fn ($record) => self::imagePreview($record?->path_pamflet)),
                                    Placeholder::make('path_twibbon')->label('Bukti Twibbon')->content(fn ($record) => self::imagePreview($record?->path_twibbon)),
                                ]),
                        ]),

                    // TAB 4: STATUS SELEKSI
                    Tabs\Tab::make('Status Kelulusan')
                        ->icon(Heroicon::OutlinedCheckBadge)
                        ->schema([
                            Section::make('Hasil Keputusan Admin')
                                ->schema([
                                    Select::make('status')
                                        ->options(['pending' => 'Pending', 'terima' => 'Diterima', 'ditolak' => 'Ditolak'])
                                        ->required()
                                        ->native(false),

                                    Select::make('accepted_division')
                                        ->label('Diterima di Divisi')
                                        ->options(self::getDivisions())
                                        ->native(false),
                                ])->columns(2),
                        ]),
                ])->columnSpanFull()->persistTabInQueryString(),
        ]);
    }

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
        return ['hrd' => 'HRD', 'pr' => 'Public Relation', 'mulmed' => 'Multimedia', 'arrait' => 'ARRAIT', 'scrabble' => 'Scrabble', 'newscasting' => 'Newscasting', 'debate' => 'Debate', 'toastmaster' => 'Toastmaster'];
    }

    protected static function getMajors(): array
    {
        return ['si' => 'Sistem Informasi', 'sk' => 'Sistem Komputer', 'ti' => 'Teknik Informatika', 'ka' => 'Komputerisasi Akuntansi', 'mi' => 'Manajemen Informatika', 'tk' => 'Teknik Komputer'];
    }
}
