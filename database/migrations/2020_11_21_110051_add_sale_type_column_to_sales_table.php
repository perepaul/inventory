<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleTypeColumnToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->enum('type',['retail','wholesale'])->default('retail');
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->enum('unit',['pieces','carton'])->default('pieces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
}
