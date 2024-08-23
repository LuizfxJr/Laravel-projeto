<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('user_level');
            $table->text('description')->nullable();
            $table->string('file')->nullable();

            $table->unsignedBigInteger('occupation_id');
            $table->unsignedBigInteger('sector_id');

            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('sector_id')->references('id')->on('sector');
           
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
