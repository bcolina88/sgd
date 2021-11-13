<?php

use Illuminate\Database\Seeder;
use App\States;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        States::create([
			"name" => "Activo"
		]);
        States::create([
			"name" => "Inactivo"
		]);
        States::create([
			"name" => "Borrado"
		]);
    }
}
