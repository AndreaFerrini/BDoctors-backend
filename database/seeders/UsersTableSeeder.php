<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('users');

        foreach ($users as $arrUsers){
            $user = User::create([

                "email"            => $arrUsers ['email'],
                "password"         => Hash::make($arrUsers['password']),
                "name"             => $arrUsers ['name'],
                "surname"         => $arrUsers ['surname'],

            ]);
            
        }
    }
}
