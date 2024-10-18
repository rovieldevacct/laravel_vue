<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Roviel Admin',
            'email' => 'roviel@gmail.com',
            'password' => Hash::make('@dmin1234'),
            'access_control' => 1,
        ]);

        User::factory(30)->create();

        User::factory()->create([
            'name' => 'Roviel Admin2',
            'email' => 'roviel2@gmail.com',
            'password' => Hash::make('@dmin1234'),
            'access_control' => 1,
        ]);
    }
}
