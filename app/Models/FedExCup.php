<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FedExCup extends Model
{
    use HasFactory;

    protected $table = 'fed_ex_cups';

    protected $guarded = ['*'];

    public function fedExCupStandings(): HasMany
    {
        return $this->hasMany(FedExCupStanding::class);
    }

}
