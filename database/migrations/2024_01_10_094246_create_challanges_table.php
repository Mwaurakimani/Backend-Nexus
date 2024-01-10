<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
    challenges
    id
    participant_id
    status (pending,accepted,rejected)
    challenger_mode (proposer,opposer,participant)
    completion_status (won,lost,draw)
     */
    public function up(): void
    {
        Schema::create('challanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_id');
            $table->string('status')->default('pending');//(pending,accepted,rejected)
            $table->string('challenger_mode');//(proposer,opposer,participant)
            $table->string('completion_status')->nullable();//(won,lost,draw)
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challanges');
    }
};
