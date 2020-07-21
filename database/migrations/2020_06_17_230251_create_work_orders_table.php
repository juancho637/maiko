<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('company_id');
            $table->string('quotation');
            $table->date('start');
            $table->string('work_order_number')->unique();
            $table->string('address');
            $table->unsignedBigInteger('city_id');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('inspection_type')->nullable();
            $table->string('certificate_name');
            $table->string('owner_email');
            $table->string('emails');
            $table->string('invoice_name');
            $table->string('invoice_nit');
            $table->string('invoice_contact_name');
            $table->string('invoice_mail');
            $table->boolean('r_mkc_002');
            $table->boolean('r_mkc_031');
            $table->boolean('r_mkc_032');
            $table->boolean('r_mkc_033');
            $table->boolean('r_mkc_045');
            $table->boolean('r_mkc_046');
            $table->boolean('r_mkc_090');
            $table->boolean('tape_measure');
            $table->boolean('caliper');
            $table->boolean('multimeter');
            $table->boolean('videoscopio');
            $table->boolean('photometer');
            $table->boolean('thermohygometer');
            $table->boolean('bridge_cam_gauge');
            $table->boolean('depth_gauge');
            $table->boolean('gauge');
            $table->boolean('thickness_gauge_ex');
            $table->boolean('reference_block_ladder_ex');
            $table->boolean('caliper_bagel');
            $table->boolean('thickness_gauge_in');
            $table->boolean('reference_block_ladder_in');
            $table->boolean('thermometer');
            $table->boolean('gas_multidetector');
            $table->boolean('harness');
            $table->boolean('mask');
            $table->boolean('slings');
            $table->boolean('lifeline');
            $table->boolean('atmospheremeter');
            $table->text('observation');
            $table->string('transport');
            $table->string('hospitals');
            $table->timestamps();
            $table->softDeletes();

            //Relations
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}
