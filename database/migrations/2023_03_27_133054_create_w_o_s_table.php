<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wo', function (Blueprint $table) {
            $table->id();
            $table->string('wo_number')->unique();
            $table->date('wo_date');
            $table->time('wo_time');
            $table->string('wo_type')->nullable()->comment('ประเภทงาน');
            $table->string('wo_breakdown')->nullable()->comment('อาการเสีย');
            $table->unsignedBigInteger('air_model')->comment('id air');
            $table->string('error_code')->nullable()->comment('รหัสข้อผิดพลาด');
            $table->decimal('wo_price', 8, 2)->nullable()->comment('ราคาค่าบริการ');
            $table->unsignedBigInteger('technician_id')->nullable()->comment('id technician');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('id customer');
            $table->boolean('wo_status')->default(false)->comment('สถานะงาน');
            $table->string('wo_remark')->nullable()->comment('หมายเหตุ');
            $table->unsignedBigInteger('wo_picture')->nullable()->comment('รูปภาพลายเซ็นลูกค้า');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('air_model')->references('id')->on('air_models');
            $table->foreign('technician_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('wo_picture')->references('id')->on('car_pictures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wo');
    }
}
