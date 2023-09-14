<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubsubsubmenuOnClientMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_menus', function (Blueprint $table) {
            $table->integer('parentSubSubSubMenus')->after('parentSubSubMenus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_menus', function (Blueprint $table) {
            $table->dropColumn('parentSubSubSubMenus');
        });
    }
}
