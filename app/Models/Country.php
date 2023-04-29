<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'code'
    ];

    public function translations(): HasMany
    {
        return $this->hasMany('countries_language', "country_id", "id");
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, "country_id", "id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "country_id", "id");
    }
}
