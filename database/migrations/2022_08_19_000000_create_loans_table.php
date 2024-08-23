<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('consigned_type');
            $table->string('consigned_value');
            $table->string('kind_benefit');
            $table->string('registration');
            $table->string('margin');
            $table->string('bank');
            $table->string('agency');
            $table->string('account');
            $table->string('type_account');
            $table->string('file_rg')->nullable();
            $table->string('file_cpf')->nullable();
            $table->string('file_ir')->nullable();
            $table->string('file_cc')->nullable();
            $table->string('status')->default('Novo');
            $table->string('observation')->nullable();
            $table->string('conclusion')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
