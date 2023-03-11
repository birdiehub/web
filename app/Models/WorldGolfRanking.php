<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorldGolfRanking extends Model
{
    use HasFactory;

    protected $table = 'world_golf_rankings';

    protected $guarded = ['*'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

}
