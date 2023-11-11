<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCustomerPriceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_customer_price_items', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->foreignIdFor(\App\Models\Product::class);
            $table->foreignIdFor(\App\Models\Customer::class);
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
        Schema::dropIfExists('product_customer_price_items');
    }
}
