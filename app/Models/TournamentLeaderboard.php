<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentLeaderboard extends Model
{
    use HasFactory;

    protected $table = 'tournament_leaderboard';

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, "tournament_id", "id");
    }

    public function player()
    {
        return $this->belongsTo(Player::class, "player_id", "id");
    }

}
