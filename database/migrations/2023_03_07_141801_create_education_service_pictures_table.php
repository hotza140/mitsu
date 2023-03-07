<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationServicePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_service_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id')->comment('id technician');
            $table->string('picture')->comment('รูปภาพ');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('technician_id')->references('id')->on('technician_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_service_pictures');
    }
}
