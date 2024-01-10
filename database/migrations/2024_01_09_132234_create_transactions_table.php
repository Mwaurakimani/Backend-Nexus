<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->decimal('credits',12);
            //TODO:LOOK INTO THIS LEVEL:HIGH
            $table->string('reference_type')->nullable();
            $table->string('reference')->nullable();
            $table->string('status')->nullable();
            //TODO:END
            $table->timestamps();
            $table->softDeletes();

            //foreign key order_id
            $table->foreign('order_id')->references('id')->on('exchange_orders')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
