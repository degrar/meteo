<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizedSliderElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localized_slider_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('slider_element_id');
            $table->integer('language_id');
            $table->string('title');
            $table->string('subtitle');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localized_slider_elements');
    }
}
