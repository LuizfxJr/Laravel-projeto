<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financings', function (Blueprint $table) {
            $table->id();
            $table->string('type_financing');
            $table->string('type_product');
            $table->string('value_product');
            $table->string('cash_entry');
            $table->string('bank_1');
            $table->string('agency_1');
            $table->string('account_1');
            $table->string('type_account_1');
            $table->string('bank_2');
            $table->string('agency_2');
            $table->string('account_2');
            $table->string('type_account_2');
            $table->string('file_rg')->nullable();
            $table->string('file_cpf')->nullable();
            $table->string('file_ir')->nullable();
            $table->string('file_cr')->nullable();
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
        Schema::dropIfExists('financings');
    }
}
