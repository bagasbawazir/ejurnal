<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuisionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quisioners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_reqrev')->unsigned();
            
            $table->string('pertanyaan',255);
            $table->string('tipe');
            $table->string('jawaban',255)->nullable();
            
            $table->timestamps();


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
        Schema::dropIfExists('quisioners');
    }
}
