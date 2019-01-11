<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsiReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isi_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_reqrev')->unsigned();
            $table->string('answer');
            
            $table->timestamps();
            $table->softDeletes();

            // belongs to one requestReview
            $table->foreign('id_reqrev')->references('id')->on('request_reviews')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('isi_reviews');
    }
}
