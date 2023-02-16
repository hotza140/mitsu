<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_service_id')->comment('id รถ');
            $table->string('picture')->comment('รูปภาพ');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_service_id')->references('id')->on('car_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_pictures');
    }
}
