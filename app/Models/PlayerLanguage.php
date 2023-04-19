<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayerLanguage extends Model
{
    use HasFactory;

    protected $table = 'players_language';

    protected $guarded = ['*'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
