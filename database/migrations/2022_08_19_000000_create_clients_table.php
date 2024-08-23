<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->date('birth_date');
            $table->date('shipping_date');
            $table->string('issuing_agency');

            $table->string('mother_name');
            $table->string('marital_status');
            $table->string('company');
            $table->string('work_regime');
            $table->string('profession');
            $table->string('gross_income');
            $table->string('net_income');
            $table->date('admission_date')->nullable();
            $table->string('address');
            $table->string('address_number');
            $table->string('address_neighborhood');
            $table->string('address_city');
            $table->string('address_state');
            $table->string('address_cep');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

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
        Schema::dropIfExists('clients');
    }
}
