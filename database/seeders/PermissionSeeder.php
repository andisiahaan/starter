<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Membuat role default
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Memberikan role admin ke User ID 1
        $user = User::find(1); // Cari user dengan ID 1
        if ($user) {
            $user->assignRole($adminRole); // Assign role admin
        }

        $user = User::find(2); // Cari user dengan ID 1
        if ($user) {
            $user->assignRole($userRole); // Assign role admin
        }

        $user = User::find(3); // Cari user dengan ID 1
        if ($user) {
            $user->assignRole($userRole); // Assign role admin
        }
    }
}
