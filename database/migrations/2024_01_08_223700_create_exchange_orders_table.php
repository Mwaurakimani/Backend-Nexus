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
        Schema::create('exchange_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer');//user making the order
            $table->unsignedBigInteger('preferred_exchange');//id of exchange the customer wants to use
            $table->string('order_type');//deposit/withdrawal
            $table->decimal('amount',12);//transaction amount
            $table->string('status');//order_made/order_confirmed/order_cancelled/order_completed/order_disputed
            $table->string('contact_type');//contact type (address, phone)
            $table->string('contact');//contact details (address, phone)
            $table->text('description')->nullable();//order description
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('customer')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('preferred_exchange')->references('id')->on('exchange_offers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_orders');
    }
};
