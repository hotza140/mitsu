<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_service_id')->comment('id tool');
            $table->string('picture')->comment('รูปภาพ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tool_service_id')->references('id')->on('tool_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_pictures');
    }
}
