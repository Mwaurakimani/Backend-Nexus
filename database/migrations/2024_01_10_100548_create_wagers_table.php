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
        Schema::create('wagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game');
            $table->integer('credits');
            $table->unsignedBigInteger('pot_value')->nullable();
            $table->integer('deductions')->nullable();// amount to be deducted from pot_value
            $table->integer('win')->nullable();//payout value
            $table->string('status')->default('open');//(open,closed,dispersed)

            $table->foreign('game')->references('id')->on('match_initiators');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wagers');
    }
};
