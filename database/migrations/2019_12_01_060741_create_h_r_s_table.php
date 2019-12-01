<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_r_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_number');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile')->default('http://res.cloudinary.com/dpcxcsdiw/image/upload/c_fit,h_150,w_150/qtw0flebtkxhcekaclwq.png');
            $table->rememberToken();
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
        Schema::dropIfExists('h_r_s');
    }
}
