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
        return $this->hasMany(CountryLanguage::class, "country_id", "id");
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, "country", "id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "country", "id");
    }
}
