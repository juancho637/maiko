<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpAccesoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_accesories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inspection_id');
            $table->string('name');
            $table->string('measure')->nullable();
            $table->string('serial')->nullable();
            $table->string('date')->nullable();
            $table->string('brand')->nullable();
            $table->string('cant')->nullable();
            $table->string('according')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //Relations
            $table->foreign('inspection_id')->references('id')->on('inspections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_accesories');
    }
}
