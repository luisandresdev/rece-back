<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Luis Andrés Bolaños Yapo',
            'email' => 'luisandres33bolanos@gmail.com',
            'password' => Hash::make('SexPistols_1'),
        ]);
    }
}
