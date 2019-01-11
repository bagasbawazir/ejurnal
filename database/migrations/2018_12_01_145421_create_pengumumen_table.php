<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jurnal')->unsigned();
            
            $table->string('title');
            $table->string('isi');
            
            $table->timestamps();
            $table->softDeletes();

            // belongs to jurnal
            $table->foreign('id_jurnal')->references('id')->on('jurnals')
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
        Schema::dropIfExists('pengumumans');
    }
}
