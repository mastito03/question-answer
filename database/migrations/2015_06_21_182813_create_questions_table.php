<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('votes')->default(0);
            $table->string('revision_message');

            //$table->integer('site_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('question_tag', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->timestamps();

            $table->index(['tag_id', 'question_id']);

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('question_tag');
        Schema::drop('questions');
    }
}
