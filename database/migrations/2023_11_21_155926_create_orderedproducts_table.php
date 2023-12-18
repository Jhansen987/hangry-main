<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderedproducts', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('product_name');
            $table->decimal('price', 8, 2)->unsigned();
            $table->string('product_image_path', 2048);
            $table->mediumInteger('quantity')->unsigned();
            $table->tinyInteger('customer_rating')->unsigned();
            $table->string('customer_message')->nullable();
            $table->string('reviewed');
            $table->timestamp('datereviewed')->nullable()->default(NULL);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderedproducts');
    }
};
