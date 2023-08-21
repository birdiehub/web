<?php

namespace App\Models;

use App\Exceptions\Custom\GeneralException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'leaderboards';

    protected $fillable = [
        'player_id',
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

    protected static function boot(): void
    {
        parent::boot();

        // Convert "D M Y" to datetime
        static::creating(function ($user) {
            $user->weekend_date = Carbon::parse($user->weekend_date);
        });

        static::updating(function ($user) {
            throw new GeneralException("Leaderboard is read-only");
        });
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

}
