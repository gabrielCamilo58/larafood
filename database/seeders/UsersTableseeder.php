<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gabriel Camilo',
            'email' => 'gabriel@gmail.com',
            'password' => bcrypt('12345'),
        ]);
    }
}
