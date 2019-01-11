<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAdminsDosensTable extends Migration
{
    //ketentuan
    //1 setiap membuat user baru pati akan memilih apakah dia admin atau dosen..
    //2 ketika membuat dosen atau admin maka dibuat dari model user(seharusnya untuk skgr begitu)
    //3 Kedepannya mungkin untuk membuat dosen, tapi bukan user..(hanya bagian dari tim penulis)
    
    public function up()
    {
        //Table User
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');//PK

            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('kategori');
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        //Table Admin
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id_user')->unsigned()->primary('id_user');//PK sekaligus FK
            
            $table->string('nama');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
        });

        //Table Dosen
        Schema::create('dosens', function (Blueprint $table) {
            $table->increments('id');//PK
            $table->integer('id_user')->unsigned();//FK

            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('jurusan');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }



    
    public function down()
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('dosens');
        Schema::dropIfExists('users');
    }
}
