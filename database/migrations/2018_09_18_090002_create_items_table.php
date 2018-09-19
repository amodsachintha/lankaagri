<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->unsignedInteger('category_id');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->float('discount')->default(0);
            $table->float('ppq')->nullable();
            $table->string('description')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->engine = "InnoDB";
        });

        Schema::table('items', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
