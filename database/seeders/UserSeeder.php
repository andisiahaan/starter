<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan pengguna admin dengan ID 1 jika belum ada
        User::firstOrCreate(
            ['id' => 1], // Cek apakah pengguna dengan ID 1 sudah ada
            [
                'email' => 'admin@admin.com',
                'name' => 'Admin',
                'password' => Hash::make('admin'),
                'email_verified_at' => Carbon::now(),
            ]
        );

        // Menambahkan pengguna User dengan ID 2 jika belum ada
        User::firstOrCreate(
            ['id' => 2], // Cek apakah pengguna dengan ID 2 sudah ada
            [
                'email' => 'user@user.com',
                'name' => 'User',
                'password' => Hash::make('user'),
                'email_verified_at' => Carbon::now(),
            ]
        );

        // Menambahkan pengguna Demo dengan ID 3 jika belum ada
        User::firstOrCreate(
            ['id' => 3], // Cek apakah pengguna dengan ID 3 sudah ada
            [
                'email' => 'demo@demo.com',
                'name' => 'Demo User',
                'password' => Hash::make('demo'),
                'email_verified_at' => Carbon::now(),
            ]
        );
    }
}
