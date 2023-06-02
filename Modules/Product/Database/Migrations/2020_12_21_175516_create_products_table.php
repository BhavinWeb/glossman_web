<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Brand::class)->constrained()->onDelete('cascade')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku');
            $table->string('image')->nullable();
            $table->integer('price');
            $table->integer('sale_price')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('total_views')->default(0);
            $table->boolean('status')->default(true);
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('hot')->default(false);
            $table->integer('total_orders')->default(0);
            $table->integer('total_rated')->default(0);
            $table->integer('total_stars')->default(0);
            $table->text('additional_information')->nullable();
            $table->text('specification')->nullable();
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
        Schema::dropIfExists('products');
    }
}
