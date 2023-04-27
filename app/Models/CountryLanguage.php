<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CountryLanguage extends Model
{
    use HasFactory;

    protected $table = 'countries_language';

    protected $fillable = [
        'country_id',
        'language',
        'name'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "country_id", "id");
    }

}
