<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\ShippingMethod\Entities\PickupPoint;
use Modules\ShippingMethod\Entities\ShippingMethod;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('coupon_type');
            $table->string('coupon_discount_amount');
            $table->float('subtotal_price');
            $table->float('total_price');
            $table->float('discount_price')->nullable();
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->enum('payment_method', ['cash', 'paypal', 'stripe', 'razorpay', 'paystack', 'flutterwave', 'mollie', 'sslcommerz'])->default('cash');
            $table->enum('order_status', ['pending', 'processing', 'on_the_way', 'delivered', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->foreignIdFor(ShippingMethod::class, 'shipping_method_id')->nullable()->onDelete('cascade');
            $table->foreignIdFor(PickupPoint::class, 'shipping_pickup_point_id')->nullable()->onDelete('cascade');
            $table->string('snap_token', 36)->nullable();

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
        Schema::dropIfExists('orders');
    }
}
