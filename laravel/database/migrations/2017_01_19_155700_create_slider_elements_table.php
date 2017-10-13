<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('slider_id');
            $table->integer('parent_id');
            $table->integer('lft');
            $table->integer('rgt');
            $table->integer('depth');
            $table->string('image');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_elements');
    }
}
