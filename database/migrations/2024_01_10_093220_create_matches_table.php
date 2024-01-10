<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
    id
    match_Initiation_id
    date_time (timestamp)
    uptime_set (true, false)
    limit_value (int)
    limit_unit (min,hrs,days,weeks,months)
    custom_details (text)
    custom_rules (text)
    status (active,suspended,booked,completed,canceled)
    global_rule
    custom_moderator_rules
     */
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_Initiation_id');
            $table->dateTime('date_time')->nullable();
            $table->boolean('uptime_set')->default(false);
            $table->integer('limit_value')->nullable();
            $table->string('limit_unit')->nullable();//(min,hrs,days,weeks,months)
            $table->string('status')->default('active');//(active,suspended,booked,completed,canceled)
            $table->text('custom_details')->nullable();
            $table->text('custom_rules')->nullable();
            $table->text('global_rule')->nullable();
            $table->text('custom_moderator_rules')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('match_Initiation_id')->references('id')->on('match_initiators');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
