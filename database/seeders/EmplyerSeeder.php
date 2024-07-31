<?php

namespace Database\Seeders;

use App\Models\Emplyee;
use App\Models\Emplyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmplyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Emplyer::factory(3)->create();
    }
}
