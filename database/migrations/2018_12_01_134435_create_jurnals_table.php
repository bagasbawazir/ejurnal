<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurnalsTable extends Migration
{
    
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_dosen')->unsigned();
            
            $table->string('title');
            $table->string('versi',20);
            $table->string('abstrak',255);
            $table->string('kategori');
            $table->string('status');// write [editing], [reviewing] menunggu review, [ready] siap publish
            $table->string('doc')->nullable()->default(null);
            $table->string('cover')->nullable()->default(null);
            // $table->link foto cover


            $table->timestamps();
            $table->softDeletes();
            
            // has one pengumuman
            // has many request_review

            // belongs to dosen
            $table->foreign('id_dosen')->references('id')->on('dosens')
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
        Schema::dropIfExists('jurnals');
    }
}
