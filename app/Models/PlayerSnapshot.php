<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerSnapshot extends Model
{
    use HasFactory;

    protected $table = 'player_snapshots';

    protected $guarded = ['*'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

}
