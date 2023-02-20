<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machanic_id')->comment('id ช่าง');
            $table->string('tool', 50)->comment('เครื่องมือ');
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
        Schema::dropIfExists('tool_services');
    }
}
