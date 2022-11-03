<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('lecture_id')->unsigned()->index()->nullable();
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
            $table->longtext('mcq_ids');
            $table->longtext('user_answers');
            $table->longtext('correct_answers');
            $table->integer('total_correct');
            $table->integer('total_wrong');
            $table->string('status')->default(1); //1->passed 0->failed
            $table->string('slug');
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
        Schema::dropIfExists('results');
    }
}
