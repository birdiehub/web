<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'leaderboard';

    protected $fillable = [
        'player_id',
        'week_number',
        'weekend_date',
        'rank',
        'last_week_rank',
        'end_last_year_rank',
        'is_tied',
        'points_lost',
        'points_won',
        'points_total',
        'points_average',
        'divisor_actual',
        'divisor_applied'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

}
