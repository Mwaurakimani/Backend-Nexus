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
        Schema::create('wager_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wager_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type');//in, out, refund, etc.
            $table->float('amount');
            $table->string('status')->default('pending');// pending, approved, rejected, etc.
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('wager_id')->references('id')->on('wagers')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wager_transactions');
    }
};
