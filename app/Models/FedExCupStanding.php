<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FedExCupStanding extends Model
{
    use HasFactory;

    protected $table = 'fed_ex_cup_standings';

    protected $guarded = ['*'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function fedExCup(): BelongsTo
    {
        return $this->belongsTo(FedExCup::class);
    }

}
