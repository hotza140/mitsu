<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machanic_id')->comment('id ช่าง');
            $table->string('brand', 100)->comment('ยี่ห้อ');
            $table->string('model', 100)->comment('รุ่น');
            $table->string('color', 100)->comment('สี');
            $table->string('number_plate', 50)->comment('ทะเบียนรถ');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('machanic_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_services');
    }
}
