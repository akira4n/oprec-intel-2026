<?php

namespace App\Filament\Resources\Applicants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ApplicantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pendaftar')
                    ->searchable()
                    ->weight('bold')
                    ->sortable(),

                TextColumn::make('user.nim')
                    ->label('NIM')
                    ->searchable()
                    ->weight('bold')
                    ->sortable(),

                TextColumn::make('major')
                    ->label('Jurusan')
                    ->formatStateUsing(fn (string $state): string => strtoupper($state))
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('divisi_satu')
                    ->label('Pilihan 1')
                    ->badge()
                    ->color('info'),

                TextColumn::make('divisi_dua')
                    ->label('Pilihan 2')
                    ->badge()
                    ->color('info')
                    ->placeholder('-'),

                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Hasil Keputusan')
                    ->badge()
                    ->color(fn ($state) => $state === 'ditolak' ? 'danger' : ($state === 'pending' ? 'warning' : 'success'))
                    ->formatStateUsing(fn (string $state) => strtoupper($state))
                    ->placeholder('Belum Ada Keputusan'),

                TextColumn::make('accepted_division')
                    ->label('Diterima Di') // Saya ganti labelnya biar lebih jelas
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn (string $state) => strtoupper($state))
                    ->placeholder('Belum Ada Keputusan'),

                TextColumn::make('score_1')
                    ->label('Skor Interview')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($state) => $state >= 80 ? 'success' : ($state >= 60 ? 'warning' : 'danger'))
                    ->placeholder('-'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([

                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'terima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
                SelectFilter::make('major')
                    ->options([
                        'si' => 'Sistem Informasi', 'sk' => 'Sistem Komputer', 'ti' => 'Teknik Informatika',
                        'ka' => 'Komputerisasi Akuntansi', 'mi' => 'Manajemen Informatika', 'tk' => 'Teknik Komputer',
                    ])->label('Filter Jurusan'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
