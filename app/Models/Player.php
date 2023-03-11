<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $guarded = ['*'];

    public function playerSnapshots(): HasMany
    {
        return $this->hasMany(PlayerSnapshot::class);
    }

    public function playerSocials(): HasMany
    {
        return $this->hasMany(PlayerSocial::class);
    }

    public function worldGolfRankings(): HasMany
    {
        return $this->hasMany(WorldGolfRanking::class);
    }

    public function fedExCupStandings(): HasMany
    {
        return $this->hasMany(FedExCupStanding::class);
    }

}
