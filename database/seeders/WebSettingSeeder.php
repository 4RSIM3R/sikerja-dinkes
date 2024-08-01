<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebSetting::create([
            'title' => 'Sikerja Dinkes',
            'content' => 'Tentang Aplikasi',
            'chief_name' => 'Dr. dr. H. Aceng Solahudin Ahmad, M. Kes',
            'chief_nip' => ' 196806122001121005',
        ]);
    }
}
