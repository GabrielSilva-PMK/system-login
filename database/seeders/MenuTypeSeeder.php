<?php

namespace Database\Seeders;

use App\Models\MenuType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuType::firstOrCreate([
            'name' => 'menu',
            'created_at' => now(),
        ]);

        MenuType::firstOrCreate([
            'name' => 'submenu',
            'created_at' => now(),
        ]);

        MenuType::firstOrCreate([
            'name' => 'tela',
            'created_at' => now(),
        ]);
    }
}
