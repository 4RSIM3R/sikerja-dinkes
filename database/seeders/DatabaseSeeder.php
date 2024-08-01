<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\User;
use App\Models\WebSetting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SpatieSeeder::class,
            UserSeeder::class,
            AppSetting::class,
            WebSetting::class,
        ]);
    }
}
