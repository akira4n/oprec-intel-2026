<?php

namespace App\Filament\Resources\Applicants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn; // Tambahkan ini
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter; // Tambahkan ini untuk filter boolean
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

                // Kolom Boolean Baru (Diletakkan sebelum status agar ringkas)
                IconColumn::make('org_sebelum')
                    ->label('Org')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),

                IconColumn::make('komitmen_tanggungjawab')
                    ->label('Komit')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'terima' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('score_1')
                    ->label('Skor')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($state) => $state >= 80 ? 'success' : ($state >= 60 ? 'warning' : 'danger'))
                    ->placeholder('-'),

                // Kolom Capaian (Hidden by default karena teksnya panjang)
                TextColumn::make('capaian')
                    ->label('Capaian')
                    ->limit(25)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'terima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),

                // Filter Baru: Memudahkan admin cari yang berpengalaman
                TernaryFilter::make('org_sebelum')
                    ->label('Punya Pengalaman Organisasi'),

                TernaryFilter::make('komitmen_tanggungjawab')
                    ->label('Sudah Menyatakan Komitmen'),

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
