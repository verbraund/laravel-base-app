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
            $table->unsignedBigInteger('role_id')->default(0);
            $table->string('login')->unique();
            $table->string('email');
            $table->string('password')->nullable();
            $table->boolean('tfa')->default(false);
            $table->string('tfa_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';

            //$table->foreign('role_id')->references('id')->on('roles');
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
