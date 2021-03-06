<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id');
            $table->string('name');
            $table->integer('type');
            $table->text('data')->nullable();
            $table->text('data_disable')->nullable();
            $table->boolean('admin')->default(0);
            $table->integer('order')->default(0);
            $table->integer('size')->default(6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_fields');
    }
}
