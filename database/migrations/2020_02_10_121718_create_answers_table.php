<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('choice_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('answers',function (Blueprint $table){
            $table->foreign('question_id')
                    ->references('question_id')
                    ->on('questions');

            $table->foreign('choice_id')
                    ->references('choice_id')
                    ->on('choices');
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
