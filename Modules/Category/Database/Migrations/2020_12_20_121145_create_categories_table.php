<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug');
            $table->integer('parent_id')->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->integer('discount')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('show_on_homepage_shop_categories')->default(0);
            $table->boolean('show_on_homepage_custom_category')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
