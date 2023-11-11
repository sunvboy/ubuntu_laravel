<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandProductCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_product_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Brand::class);
            $table->foreignIdFor(\App\Models\Product::class);
            $table->text('products');
            $table->integer('quantity');
            $table->integer('price_import');
            $table->string('date_end');
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
        Schema::dropIfExists('brand_product_carts');
    }
}
