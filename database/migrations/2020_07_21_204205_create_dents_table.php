<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('inspection_id');
            $table->string('large');
            $table->string('width');
            $table->string('average');
            $table->text('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //Relations
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('dents');
    }
}
