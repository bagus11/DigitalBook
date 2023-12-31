<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientMenusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
            $table->string('icon');
            $table->string('link');
            $table->integer('parentMenu');
            $table->integer('parentSubmenus');
            $table->integer('status');
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
        Schema::dropIfExists('client_menus');
    }
}
