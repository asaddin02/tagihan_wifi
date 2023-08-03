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
            'user_id' => 101,
            'name' => 'Yanto Krupuk',
            'no_telepon' => '087809898765',
            'email' => 'yanto@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
        ]);

        $this->call(PackageSeeder::class);

        $this->call(TechnisianSeeder::class);
    }
}
