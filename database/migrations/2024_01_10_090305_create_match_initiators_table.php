<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     *
     continuous_games
    players_mode(1v1,2v2,3v3,4v4,solo,custom)
    team_required (true,false)
    strict_player_mode(true,false)
    player_count (if set as custom and strict is true)
    Game_type (front_line, gun_match, dominaion,...)
     */
    public function up(): void
    {
        Schema::create('match_initiators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initiator');//person who started the match
            $table->unsignedBigInteger('match_mode'); //(private_match,bracket,battle_royal,league,custom)
            $table->unsignedBigInteger('continuous_games')->default(0);//number of continuous games to determine the winner
            $table->string('players_mode');//(1v1,2v2,3v3,4v4,solo,custom)
            $table->boolean('team_required')->default(false);//(true,false) if team is required
            $table->boolean('strict_player_mode')->default(false);//(true,false) if strict player mode is required
            $table->unsignedBigInteger('player_count')->default(0);//number of players if strict_player_mode is true
            $table->string('game_type');//(front_line, gun_match, domination,...)
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('initiator')->references('id')->on('users');
            $table->foreign('match_mode')->references('id')->on('match_modes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_initiators');
    }
};

