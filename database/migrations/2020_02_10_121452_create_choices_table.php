<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->bigInteger('choice_id')->unsigned()->index();
            $table->bigInteger('question_id')->unsigned();
            $table->string('choice');
            $table->integer('value');
            $table->timestamps();
        });

        Schema::table('choices',function (Blueprint $table){
            $table->foreign('question_id')
                    ->references('question_id')
                    ->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
