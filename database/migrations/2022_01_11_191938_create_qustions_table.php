<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQustionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qustions', function (Blueprint $table) {
            $table->id();
            $table->string('qustion');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('answer');
            $table->string('date');
            $table->integer('coins');
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
        Schema::dropIfExists('qustions');
    }
}
