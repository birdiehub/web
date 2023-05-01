<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Player extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'players';

    protected $fillable = [
        'first_name',
        'last_name',
        'headshot',
        'is_amateur',
        'birth_date',
        'turned_pro',
        'college',
        'graduation_year',
        'career_earnings',
        'height_imperial',
        'height_meters',
        'weight_imperial',
        'weight_kilograms',
        'gender',
        'bio',
        'degree',
        'family',
        'country_id'
    ];

    public $translatable = [
        'gender',
        'bio',
        'degree',
        'family'
    ];


    public function snapshots(): HasMany
    {
        return $this->hasMany(Snapshot::class, "player_id", "id");
    }

    public function socials(): HasMany
    {
        return $this->hasMany(Social::class, 'player_id', 'id');
    }

    public function leaderboard(): HasMany
    {
        return $this->hasMany(Leaderboard::class, 'player_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "country_id", "id");
    }

    public function currentRank(): Model
    {
        // order by weekend_date desc, week_number desc
        return $this->leaderboard()->orderBy('weekend_date', 'desc')->orderBy('week_number', 'desc')->first();
    }
}
