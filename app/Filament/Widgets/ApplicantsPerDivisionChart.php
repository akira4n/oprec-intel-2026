<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ApplicantsPerDivisionChart extends ChartWidget
{
    // HAPUS 'static' DI SINI
    protected ?string $heading = 'Peminat per Divisi (Pilihan 1)';

    // Kalau $sort biasanya tetap static, tapi kalau error juga, hapus static-nya
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Applicant::select('divisi_satu', DB::raw('count(*) as total'))
            ->groupBy('divisi_satu')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peminat',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#1d4ed8',
                ],
            ],
            'labels' => $data->pluck('divisi_satu')->map(fn ($val) => strtoupper($val)),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
