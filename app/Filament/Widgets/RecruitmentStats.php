<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RecruitmentStats extends BaseWidget
{
    // Ini WAJIB static (sesuai aturan induk Widget)
    protected static ?int $sort = 1;

    // Ini WAJIB non-static (sesuai aturan StatsOverviewWidget baru)
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendaftar', Applicant::count())
                ->description('Seluruh mahasiswa yang mendaftar')
                ->descriptionIcon(Heroicon::OutlinedUserGroup)
                ->color('info')
                ->chart([5, 10, 8, 15, 12, 20, 18]),

            Stat::make('Pending', Applicant::where('status', 'pending')->count())
                ->description('Belum diberikan keputusan')
                ->descriptionIcon(Heroicon::OutlinedClock)
                ->color('warning'),

            Stat::make('Diterima', Applicant::where('status', 'terima')->count())
                ->description('Pendaftar yang dinyatakan lulus')
                ->descriptionIcon(Heroicon::OutlinedCheckCircle)
                ->color('success'),

            Stat::make('Ditolak', Applicant::where('status', 'ditolak')->count())
                ->description('Pendaftar yang belum beruntung')
                ->descriptionIcon(Heroicon::OutlinedXCircle)
                ->color('danger'),
        ];
    }
}
