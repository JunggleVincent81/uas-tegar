<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin    = Role::where('name', 'admin')->first();
        $cashier  = Role::where('name', 'cashier')->first();
        $chef     = Role::where('name', 'chef')->first();
        $customer = Role::where('name', 'customer')->first();

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role_id' => $admin->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@kasir.com'],
            [
                'name' => 'Kasir',
                'password' => Hash::make('kasir123'),
                'role_id' => $cashier->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'chef@chef.com'],
            [
                'name' => 'Chef',
                'password' => Hash::make('chef123'),
                'role_id' => $chef->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@user.com'],
            [
                'name' => 'Customer',
                'password' => Hash::make('user123'),
                'role_id' => $customer->id,
            ]
        );
    }
}
