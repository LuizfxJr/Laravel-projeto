<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_id');
            $table->unsignedBigInteger('user_id');
            $table->string('action');
            $table->timestamps();

            $table->foreign('financing_id')->references('id')->on('financings');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_logs');
    }
}
