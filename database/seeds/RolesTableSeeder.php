<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
        	"name" => "Administrador"
        ]);
        Roles::create([
        	"name" => "Cargue"
        ]);
        Roles::create([
        	"name" => "Consulta"
        ]);
    }
}
