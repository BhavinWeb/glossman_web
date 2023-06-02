<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Order\Entities\Order;
use Modules\Product\Entities\Product;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignIdFor(Product::class)->onDelete('cascade');
            $table->string('price');
            $table->string('quantity');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('casCade');
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
        Schema::dropIfExists('order_products');
    }
}
