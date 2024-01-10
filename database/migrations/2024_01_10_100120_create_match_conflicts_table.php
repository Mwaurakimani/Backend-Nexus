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
        Schema::create('match_conflicts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('handler');
            $table->string('reason')->nullable();
            $table->string('status')->default('pending');//(pending,in_process,resolved)
            $table->string('action')->nullable();//(in_favor_of_proposer,in_favor_of_opposer,elevated,canceled_match)
            $table->text('resolution_description')->nullable();
            $table->string('resolution_status')->default('unresolved');//(resolved,unresolved)

            $table->foreign('match_id')->references('id')->on('matches')->onDelete('restrict');
            $table->foreign('handler')->references('id')->on('users')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_conflicts');
    }
};
