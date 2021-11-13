<?php

use Illuminate\Database\Seeder;

class fieldTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\FieldType::create([
            "name" => "number"
        ]);
        \App\FieldType::create([
            "name" => "text"
        ]);
        \App\FieldType::create([
            "name" => "email"
        ]);
        \App\FieldType::create([
            "name" => "date"
        ]);
        \App\FieldType::create([
            "name" => "select"
        ]);
    }
}
