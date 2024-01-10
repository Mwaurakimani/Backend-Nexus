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
        Schema::create('exchange_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moderator');
            $table->string('offer_type');//deposit/withdrawal
            $table->string('mode');//m-pesa/world-coin
            $table->string('contact_type');//address/phone_number
            $table->string('contact');//contact number or address
            $table->decimal('price',12);//value per credit
            $table->string('currency');//ksh/usd
            $table->string('turnover_time_unit');//how long to process the offer, e.g. days, hours, minutes, seconds, etc.
            $table->unsignedBigInteger('turnover_time_value');//value based on the turnover_time_unit
            $table->string('available_from');//available from time in 24hr format
            $table->string('available_to');//available to time in 24hr format
            $table->decimal('min_order',12);//min order value for credits
            $table->decimal('max_order',12);//max order value for credits
            $table->string('status');//active/inactive
            $table->timestamps();
            $table->softDeletes();

            //moderator foreign key
            $table->foreign('moderator')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_offers');
    }
};
