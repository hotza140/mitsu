<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicianServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machanic_id')->comment('id ช่าง');
            $table->string('fname', 50)->comment('ชื่อ');
            $table->string('lname', 50)->comment('นามสกุล');
            $table->string('nick_name', 50)->comment('ชื่อเล่น');
            $table->string('phone', 20)->comment('เบอร์โทร');
            $table->string('line', 100)->comment('line');
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
        Schema::dropIfExists('technician_services');
    }
}
