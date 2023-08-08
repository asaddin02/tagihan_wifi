<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'user_id' => 0001,
            'name' => 'Yanto Krupuk',
            'no_telepon' => '087809898765',
            'email' => 'yanto@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'user_id' => 0002,
            'name' => 'Customer Service',
            'no_telepon' => '083847746736',
            'email' => 'cs@gmail.com',
            'password' => Hash::make('cs123'),
            'role' => 'Customer Service',
        ]);

        $this->call(PackageSeeder::class);

        $this->call(TechnisianSeeder::class);
    }
}
