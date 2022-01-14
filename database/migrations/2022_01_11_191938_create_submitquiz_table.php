<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitquiz', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('testId')->nullable();
            $table->string('qustion')->nullable();
            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
            $table->string('option_c')->nullable();
            $table->string('answer')->nullable();
            $table->string('date')->nullable();
            $table->integer('coins')->nullable();
            $table->string('useranswer')->nullable();
            $table->string('getCoin')->nullable();
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
        Schema::dropIfExists('submitquiz');
    }
}
