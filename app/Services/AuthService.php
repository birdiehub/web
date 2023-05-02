<?php

namespace App\Services;

use App\Models\User;
use App\Validators\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthService extends Service
{
    protected array $_registerRules = [
        'username' => 'required|string|max:255||unique:users,username',
        'password' => 'required|string|max:255|min:8',
        "first_name" => "required|string",
        "last_name" => "required|string",
        "email" => "required|email|max:255",
        "phone" => "required|string",
        "address" => "required|string",
        "city" => "required|string",
        "zip" => "required|string",
        "country_id" => "required|int"
    ];

    protected array $_loginRules = [
        'username' => 'required|string',
        'password' => 'required|string'
    ];
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function register($data): string
    {
        Validator::standalone($data, $this->_registerRules);
        $user = parent::create($data);
        $user->assignRole('viewer');
        return $this->authenticate($data['username'], $data['password']);
    }


    public function login($data): string
    {
        Validator::standalone($data, $this->_loginRules);
        return $this->authenticate($data['username'], $data['password']);
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function refresh(): string
    {
        return auth()->refresh();
    }

    public function me() : Model
    {
        return User::findOrFail(Auth::id());
    }


    private function authenticate($username, $password) : string
    {
        $token = auth()->attempt([
            'username' => $username,
            'password' => $password
        ]);
        if (!$token) throw new AuthenticationException(Lang::get('auth.failed'));
        return $token;
    }
}
