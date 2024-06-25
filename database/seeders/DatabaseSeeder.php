<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userData = [
            [
                'nama' => 'Administrator',
                'email' => 'wida@gmail.com',
                'password' => bcrypt('11221122'),
                'role' => 'admin',
                'alamat' => '-',
                'no_hp' => '-'
            ],
        ];

        DB::table('users')->insert($userData);

        $pengaturanData = [
            [
                'nama' => 'Toko ABC',
                'email' => 'wida@gmail.com',
                'no_hp' => '08987654321',
                'alamat' => 'Jl. ABC No. 123',
                'logo' => 'logo.png',
                'deskripsi' => 'Toko ABC adalah toko paling bagus di Indonesia.',
            ],
        ];

        DB::table('pengaturans')->insert($pengaturanData);
    }
}
