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
            "name" => "prueba",
            "email" => "prueba@prueba.com",
            "password" => bcrypt("1234"),
            "role_id" => 1,
            "cargo" => "Adminitrador",
            "state_id" => 1
        ]);
    }
}
