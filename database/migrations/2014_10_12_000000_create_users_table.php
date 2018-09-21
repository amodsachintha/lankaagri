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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nic')->unique();
            $table->string('mobile')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('st_address')->nullable();
            $table->string('avatar')->default('storage/avatars/default.png');
            $table->boolean('isadmin')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->engine = "InnoDB";
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
