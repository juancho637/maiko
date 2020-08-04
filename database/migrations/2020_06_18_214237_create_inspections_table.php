<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('work_order_id');
            $table->string('certificate_number')->unique()->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('tank_id')->nullable();
            $table->date('date');
            $table->string('address')->nullable();
            $table->string('light_intensity')->nullable();
            $table->string('humidity')->nullable();
            $table->string('temperature')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->text('observation')->nullable();
            $table->boolean('total')->default(false);
            $table->timestamps();
            $table->softDeletes();

            //Relations
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('work_order_id')->references('id')->on('work_orders');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('tank_id')->references('id')->on('tanks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspections');
    }
}
