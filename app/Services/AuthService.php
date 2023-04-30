<?php

namespace App\Services;

use App\Models\User;
use App\Validators\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $unhashedPassword = $data['password'];
        $data['password'] = Hash::make($unhashedPassword);

        $user = parent::create($data);
        return $this->authenticate($data['username'], $unhashedPassword);
    }


    public function login($data): string
    {
        Validator::standalone($data, $this->_loginRules);
        return $this->authenticate($data['username'], $data['password']);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function refresh(): string
    {
        return auth('api')->refresh();
    }

    public function me() : Model
    {
        return User::findOrFail(Auth::id());
    }


    private function authenticate($username, $password) : string
    {
        $token = auth('api')->attempt([
            'username' => $username,
            'password' => $password
        ]);
        if (!$token) throw new AuthenticationException("Invalid username or password");
        return $token;
    }
}
