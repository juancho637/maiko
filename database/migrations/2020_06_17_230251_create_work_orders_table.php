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
            $table->boolean('r_mkc_002')->default(false);
            $table->boolean('r_mkc_031')->default(false);
            $table->boolean('r_mkc_032')->default(false);
            $table->boolean('r_mkc_033')->default(false);
            $table->boolean('r_mkc_045')->default(false);
            $table->boolean('r_mkc_046')->default(false);
            $table->boolean('r_mkc_090')->default(false);
            $table->boolean('tape_measure')->default(false);
            $table->boolean('caliper')->default(false);
            $table->boolean('multimeter')->default(false);
            $table->boolean('videoscopio')->default(false);
            $table->boolean('photometer')->default(false);
            $table->boolean('thermohygometer')->default(false);
            $table->boolean('bridge_cam_gauge')->default(false);
            $table->boolean('depth_gauge')->default(false);
            $table->boolean('gauge')->default(false);
            $table->boolean('thickness_gauge_ex')->default(false);
            $table->boolean('reference_block_ladder_ex')->default(false);
            $table->boolean('caliper_bagel')->default(false);
            $table->boolean('thickness_gauge_in')->default(false);
            $table->boolean('reference_block_ladder_in')->default(false);
            $table->boolean('thermometer')->default(false);
            $table->boolean('gas_multidetector')->default(false);
            $table->boolean('harness')->default(false);
            $table->boolean('mask')->default(false);
            $table->boolean('slings')->default(false);
            $table->boolean('lifeline')->default(false);
            $table->boolean('atmospheremeter')->default(false);
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
