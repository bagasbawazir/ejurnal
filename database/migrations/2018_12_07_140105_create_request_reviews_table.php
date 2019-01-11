<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_reviewer')->unsigned();
            $table->integer('id_jurnal')->unsigned();

            $table->string('url_token');//token akses enkripsi [nama jurnal-nama reviewer]
            $table->string('kode',20);//masukan kode berikut..(pas di email)  //jaga2 beken dua
            
            $table->string('status');//  menunggu akses email, diterima/sedang review, di tolak/expired
            

            $table->timestamps();
            $table->softDeletes();

            //has many quisioner, isireview/jawabanreview..
            // belongs to one jurnal
            $table->foreign('id_jurnal')->references('id')->on('jurnals')
                    ->onDelete('cascade')->onUpdate('cascade');
            // belongs to one reviewer
            $table->foreign('id_reviewer')->references('id')->on('reviewers')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('request_reviews');
    }
}
