<?php

namespace Database\Seeders;

use App\Models\Technisian;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnisianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technisian::create([
            'nama_teknisi' => 'Atok Farmfenzy',
            'alamat' => 'Kav. Baru Jl. Soekarno No. 69',
            'no_telepon' => '087876705654',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
