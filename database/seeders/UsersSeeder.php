<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
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
        $user = User::create([
            'name' => 'Luis Andrés Bolaños Yapo',
            'email' => 'luisandres33bolanos@gmail.com',
            'password' => Hash::make('SexPistols_1'),
        ]);

        Category::upsert([
            ['user_id' => $user->id, 'name' => 'Entrada'],
            ['user_id' => $user->id, 'name' => 'Plato Principal'],
            ['user_id' => $user->id, 'name' => 'Postre'],
        ], ['user_id', 'name'], ['name']);

        Tag::upsert([
            ['user_id' => $user->id, 'name' => 'Rápido'],
            ['user_id' => $user->id, 'name' => 'Rico'],
            ['user_id' => $user->id, 'name' => 'Sano'],
        ], ['user_id', 'name'], ['name']);
    }
}
