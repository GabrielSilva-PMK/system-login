<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile();
        $profile = $profile->where('name', 'root')->get()->toArray();

        // dd($profile);

        foreach ($profile as $key => $value) {
            User::firstOrCreate([
                'id_profile' => $value['id'],
                'name' => 'root',
                'email' => 'root@root.com',
                'email_verified_at' => now(),
                'password' => bcrypt('P@ssw0rd'),
                'created_at' => now(),
            ]);
        }
    }
}
