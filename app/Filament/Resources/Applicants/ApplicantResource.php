<?php

namespace App\Filament\Resources\Applicants;

use App\Filament\Resources\Applicants\Pages\CreateApplicant;
use App\Filament\Resources\Applicants\Pages\EditApplicant;
use App\Filament\Resources\Applicants\Pages\ListApplicants;
use App\Filament\Resources\Applicants\Pages\ViewApplicant;
use App\Filament\Resources\Applicants\Schemas\ApplicantForm;
use App\Filament\Resources\Applicants\Tables\ApplicantsTable;
use App\Models\Applicant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ApplicantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApplicantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApplicants::route('/'),
            'create' => CreateApplicant::route('/create'),
            'view' => ViewApplicant::route('/{record}'),
            'edit' => EditApplicant::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     $query = parent::getEloquentQuery();
    //     $user = auth()->user(); // Ambil user yang sedang login

    //     // 1. Jika Super Admin, tampilkan semua (langsung return query asli)
    //     if ($user->role === 'super_admin') {
    //         return $query;
    //     }

    //     // 2. Jika Divisi Admin, filter berdasarkan divisinya
    //     if ($user->role === 'divisi_admin' && ! empty($user->division)) {
    //         return $query->where(function (Builder $q) use ($user) {
    //             // Tampilkan jika Pilihan 1 ADALAH divisi admin
    //             $q->where('divisi_satu', $user->division)
    //               // ATAU Pilihan 2 ADALAH divisi admin
    //                 ->orWhere('divisi_dua', $user->division);
    //         });
    //     }
    // }
}
