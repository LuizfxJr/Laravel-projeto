<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontoTable extends Migration
{
    public function up()
    {
        Schema::create('pontos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('data');
            $table->timestamp('hora_entrada')->nullable();
            $table->timestamp('hora_saida')->nullable();
            $table->timestamp('hora_intervalo_saida')->nullable();
            $table->timestamp('hora_intervalo_volta')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pontos');
    }
}
