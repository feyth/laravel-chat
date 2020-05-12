<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'João Vitor',
            'email'     => 'joao.vitor@gmail.com',
            'password'     => \Hash::make('12345678')
        ]);
        User::create([
            'name'  => 'Maria Aparecida',
            'email'     => 'maria.aparecida@gmail.com',
            'password'     => \Hash::make('12345678')
        ]);
        User::create([
            'name'  => 'André Soares',
            'email'     => 'andre.soares@gmail.com',
            'password'     => \Hash::make('12345678')
        ]);
    }
}
