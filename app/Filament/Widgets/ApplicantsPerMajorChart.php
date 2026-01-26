<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ApplicantsPerMajorChart extends ChartWidget
{
    // HAPUS 'static' JUGA DI SINI
    protected ?string $heading = 'Sebaran Jurusan Pendaftar';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Applicant::select('major', DB::raw('count(*) as total'))
            ->groupBy('major')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jurusan',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => [
                        '#f59e0b', '#10b981', '#3b82f6', '#ef4444', '#8b5cf6', '#ec4899',
                    ],
                ],
            ],
            'labels' => $data->pluck('major')->map(fn ($val) => strtoupper($val)),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
