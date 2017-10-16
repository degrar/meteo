<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps('data_insert');
            $table->string('data');
            $table->string('hour');
            $table->string('temp_actual');
            $table->string('temp_max');
            $table->string('temp_min');
            $table->string('humitat_actual');
            $table->string('humitat_max');
            $table->string('humitat_min');
            $table->string('pres_actual');
            $table->string('pres_max');
            $table->string('pres_min');
            $table->string('vent_actual');
            $table->string('vent_direccio');
            $table->string('vent_max');
            $table->string('pluja_max');
            $table->string('pluja_int');
            $table->string('uv');
            $table->string('radiation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current');
    }
}
