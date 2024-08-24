<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'setting_name' => 'phone',
            'setting_value' => '017354867473',
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email',
            'setting_value' => 'admin@gmail.com',
        ]);
    }
}
