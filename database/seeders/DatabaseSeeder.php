<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil password dari .env, kalau gak ada pake 'password123' sebagai cadangan
        $password = Hash::make(env('ADMIN_PASSWORD', 'password123'));

        // 2. Buat Super Admin
        User::create([
            'name' => 'Super Admin INTEL',
            'email' => 'admin@intel.com',
            'nim' => '0000000000',
            'role' => 'super_admin',
            'no_hp' => '080000000000',
            'password' => $password,
        ]);

        // 3. Buat Admin per Divisi secara otomatis
        $divisions = ['hrd', 'pr', 'mulmed', 'arrait', 'scrabble', 'newscasting', 'debate', 'toastmaster'];

        foreach ($divisions as $index => $div) {
            User::create([
                'name' => 'Admin '.strtoupper($div),
                'email' => $div.'@intel.com',
                'nim' => '111111111'.($index + 1), // NIM unik
                'role' => 'divisi_admin',
                'no_hp' => '0812345678'.$index,
                'division' => $div,
                'password' => $password,
            ]);
        }
    }
}
