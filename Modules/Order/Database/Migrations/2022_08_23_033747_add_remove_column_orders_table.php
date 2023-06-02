<?php

use App\Models\ManualPayment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemoveColumnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_method', ['offline', 'paypal', 'stripe', 'razorpay', 'paystack', 'flutterwave', 'mollie', 'sslcommerz'])->default('offline');
            $table->foreignIdFor(ManualPayment::class)->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {
        });
    }
}
