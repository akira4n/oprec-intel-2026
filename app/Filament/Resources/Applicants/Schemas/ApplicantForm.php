<?php

namespace App\Filament\Resources\Applicants\Schemas;

use Filament\Forms\Components\FileUpload;
// Layout menggunakan namespace Schemas (Sesuai file js/filament/schemas)
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
// Input KEMBALI menggunakan namespace Forms (Sesuai file js/filament/forms)
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ApplicantForm
{
    public static function configure(Schema $schema): Schema
    {
        // Di v5, kita panggil ->components() pada objek Schema
        return $schema->components([
            Tabs::make('Recruitment Detail')
                ->tabs([
                    // TAB 1: IDENTITAS & AKADEMIK
                    Tabs\Tab::make('Identity & Academic')
                        ->icon(Heroicon::OutlinedUser)
                        ->schema([
                            Section::make('Data Mahasiswa')
                                ->description('Informasi dasar pendaftar dari database.')
                                ->schema([
                                    Select::make('user_id')
                                        ->relationship('user', 'name')
                                        ->label('Full Name')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->disabledOn('edit'),

                                    Select::make('major')
                                        ->options(self::getMajors())
                                        ->label('Major')
                                        ->required(),

                                    Select::make('batch')
                                        ->options(['2024' => '2024', '2025' => '2025'])
                                        ->label('Batch')
                                        ->required(),
                                ])->columns(3),

                            Section::make('Background')
                                ->schema([
                                    Textarea::make('alasan_utama')
                                        ->label('Why join INTEL?')
                                        ->rows(4)
                                        ->required(),
                                ]),
                        ]),

                    // TAB 2: PILIHAN DIVISI
                    Tabs\Tab::make('Division Choices')
                        ->icon(Heroicon::OutlinedRectangleGroup)
                        ->schema([
                            Section::make('Primary Choice')
                                ->schema([
                                    Select::make('divisi_satu')
                                        ->options(self::getDivisions())
                                        ->label('1st Priority Division')
                                        ->required(),
                                    Textarea::make('alasan_satu')
                                        ->label('Why this division?')
                                        ->required(),
                                ])->columns(2),

                            Section::make('Secondary Choice')
                                ->schema([
                                    Select::make('divisi_dua')
                                        ->options(self::getDivisions())
                                        ->label('2nd Priority Division (Optional)'),
                                    Textarea::make('alasan_dua')
                                        ->label('Secondary Reason'),
                                ])->columns(2),
                        ]),

                    // TAB 3: TUGAS & SOCIAL MEDIA
                    Tabs\Tab::make('Tasks & Campaign')
                        ->icon(Heroicon::OutlinedDocumentCheck)
                        ->schema([
                            Section::make('Submission Files')
                                ->schema([
                                    FileUpload::make('path_tugas_satu')
                                        ->label('Main Task File')
                                        ->directory('tugas')
                                        ->downloadable()
                                        ->required(),
                                    FileUpload::make('path_tugas_dua')
                                        ->label('Supporting Task')
                                        ->directory('tugas')
                                        ->downloadable(),
                                ])->columns(2),

                            Section::make('Social Media Presence')
                                ->schema([
                                    TextInput::make('path_tiktok')
                                        ->url()
                                        ->label('TikTok Video Link')
                                        ->placeholder('https://tiktok.com/...')
                                        ->required(),
                                    TextInput::make('path_instagram')
                                        ->url()
                                        ->label('Instagram Post Link')
                                        ->placeholder('https://instagram.com/...')
                                        ->required(),
                                    FileUpload::make('path_pamflet')
                                        ->image()
                                        ->label('Proof of Share (Pamflet)')
                                        ->directory('proofs')
                                        ->required(),
                                    FileUpload::make('path_twibbon')
                                        ->image()
                                        ->label('Proof of Upload (Twibbon)')
                                        ->directory('proofs')
                                        ->required(),
                                ])->columns(2),
                        ]),

                    // TAB 4: SELEKSI (KHUSUS ADMIN)
                    Tabs\Tab::make('Selection Status')
                        ->icon(Heroicon::OutlinedCheckBadge)
                        ->schema([
                            Section::make('Final Decision')
                                ->description('Tentukan hasil akhir pendaftaran mahasiswa ini.')
                                ->schema([
                                    Select::make('status')
                                        ->options([
                                            'pending' => 'Pending',
                                            'terima' => 'Accepted',
                                            'ditolak' => 'Rejected',
                                        ])
                                        ->default('pending')
                                        ->required(),
                                    Select::make('accepted_division')
                                        ->options(self::getDivisions())
                                        ->label('Placed in Division'),
                                ])->columns(2),
                        ]),
                ])
                ->columnSpanFull()
                ->persistTabInQueryString(), // Biar kalau refresh gak balik ke tab awal
        ]);
    }

    protected static function getDivisions(): array
    {
        return [
            'hrd' => 'HRD', 'pr' => 'Public Relation', 'mulmed' => 'Multimedia',
            'arrait' => 'ARRAIT', 'scrabble' => 'Scrabble',
            'newscasting' => 'Newscasting', 'debate' => 'Debate', 'toastmaster' => 'Toastmaster',
        ];
    }

    protected static function getMajors(): array
    {
        return [
            'si' => 'Sistem Informasi', 'sk' => 'Sistem Komputer', 'ti' => 'Teknik Informatika',
            'ka' => 'Komputerisasi Akuntansi', 'mi' => 'Manajemen Informatika', 'tk' => 'Teknik Komputer',
        ];
    }

    protected static function downloadLink($path)
    {
        if (! $path) {
            return '-';
        }

        $url = Storage::url($path);

        // Kita styling tag <a> supaya bentuknya kayak tombol Filament asli
        return new HtmlString("
            <a href='{$url}' target='_blank' 
               class='inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-primary-600 rounded-lg shadow hover:bg-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2'>
                
                <svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'></path>
                </svg>

                <span>Download Tugas</span>
            </a>
        ");
    }
}
