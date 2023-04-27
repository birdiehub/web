<?php

namespace App\Modules\Users\Services;

use App\Exceptions\ForbiddenAccessException;
use App\Exceptions\ValidatorException;
use App\Models\User;
use App\Models\UserRole;
use App\Modules\Core\Services\Service;
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
        "country" => "required|int",
        "role" => "prohibited"
    ];

    protected array $_loginRules = [
        'username' => 'required|string',
        'password' => 'required|string',
        "role" => "prohibited"
    ];
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @throws ForbiddenAccessException
     * @throws ValidatorException
     */
    public function register($data): string
    {
        $this->validate($data, $this->_registerRules);

        $credentials = [
            'username' => $data['username'],
            'password' => $data['password']
        ];

        $data['password'] = Hash::make($data['password']);
        $data['role'] = UserRole::where('name', 'user')->first()->id;

        $user = $this->_model->create($data);
        return $this->authenticate($credentials);
    }

    /**
     * @throws ForbiddenAccessException
     * @throws ValidatorException
     */
    function login($data): string
    {
        $this->validate($data, $this->_loginRules);
        return $this->authenticate([
            'username' => $data['username'],
            'password' => $data['password']
        ]);
    }

    /**
     * @throws ForbiddenAccessException
     */
    private function authenticate($credentials) : string
    {
        $token = auth()->attempt($credentials);
        if (!$token) throw new ForbiddenAccessException("Invalid username or password");
        return $token;
    }
}
