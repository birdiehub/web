<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'zip',
        'country',
        'role'
    ];
    /*
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier() : mixed
    {
        return $this->getKey();
    }

    /*
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims() : array
    {
        return [];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

}
