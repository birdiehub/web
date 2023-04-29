<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Snapshot extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'snapshots';

    protected $fillable = [
        'player_id',
        'title',
        'value',
        'description',
    ];

    public $translatable = [
        'title',
        'value',
        'description',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }
}
