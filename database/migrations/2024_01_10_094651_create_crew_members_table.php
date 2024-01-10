<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     id
    crew_id
    user_id
    status (active,suspended)
    suspend_period (seconds)
     */
    public function up(): void
    {
        Schema::create('crew_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crew_id');
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('suspend_period');
            $table->foreign('crew_id')->references('id')->on('crews');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['crew_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew_members');
    }
};
