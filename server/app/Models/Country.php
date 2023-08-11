<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'countries';

    protected $fillable = [
        'code',
        'name'
    ];

    public $translatable = [
        'name'
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, "country_id", "id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "country_id", "id");
    }
}
