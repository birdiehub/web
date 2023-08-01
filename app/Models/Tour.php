<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    public function tournaments()
    {
        return $this->hasMany(Tournament::class, "tour_id", "id");
    }

}
