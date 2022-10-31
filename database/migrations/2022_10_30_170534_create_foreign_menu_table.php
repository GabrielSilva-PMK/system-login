<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->unsignedBigInteger('id_menu_type')->after('id');
            $table->foreign('id_menu_type')->references('id')->on('profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropForeign(['id_menu_type']);
            $table->dropColumn('id_menu_type');
        });
    }
};
