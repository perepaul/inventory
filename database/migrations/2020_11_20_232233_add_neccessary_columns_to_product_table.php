<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNeccessaryColumnsToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->dropColumn('alert_quantity');
            // $table->dropColumn('purchase_price');
            // $table->dropColumn('price');
            // $table->dropColumn('discount');
            // $table->dropColumn('quantity');
            // $table->dropColumn('description');
            // $table->string('description');
            $table->unsignedDouble('pieces_retail_price');
            $table->unsignedDouble('pieces_wholesale_price');
            $table->unsignedDouble('pieces_cost_price');
            $table->unsignedBigInteger('pieces_stock');
            $table->unsignedBigInteger('pieces_alert_quantity');

            $table->unsignedDouble('carton_retail_price')->nullable();
            $table->unsignedDouble('carton_wholesale_price')->nullable();
            $table->unsignedDouble('carton_cost_price')->nullable();
            $table->unsignedBigInteger('carton_stock')->nullable();
            $table->unsignedBigInteger('carton_alert_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('pieces_retail_price');
            $table->dropColumn('pieces_wholesale_price');
            $table->dropColumn('pieces_cost_price');
            $table->dropColumn('pieces_stock');
            $table->dropColumn('pieces_alert_quantity');

            $table->dropColumn('carton_retail_price');
            $table->dropColumn('carton_wholesale_price');
            $table->dropColumn('carton_cost_price');
            $table->dropColumn('carton_stock');
            $table->dropColumn('carton_alert_quantity');

            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('alert_quantity');
            $table->unsignedDouble('purchase_price');
            $table->unsignedDouble('price');
            $table->unsignedDouble('discount')->nullable();
        });
    }
}
