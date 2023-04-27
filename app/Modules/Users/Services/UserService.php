<?php

namespace App\Modules\Users\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ValidatorException;
use App\Models\User;
use App\Modules\Core\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService extends Service
{
    protected array $_updateRules = [
        "id"=> "prohibited",
        'username' => 'string|max:255||unique:users,username',
        'password' => 'string|max:255|min:8',
        "first_name" => "string",
        "last_name" => "string",
        "email" => "email|max:255",
        "phone" => "string",
        "address" => "string",
        "city" => "string",
        "zip" => "string",
        "country" => "int|exists:countries,id",
        "role" => "prohibited"
    ];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function all() : Builder {
        return $this->_model
            ->with("country")
            ->select("id", "username", "first_name", "last_name", "country");
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function get($id) : Model {
        $user = $this->_model
            ->with("role")
            ->with("country")
            ->find($id);

        if(!$user)
            throw new ResourceNotFoundException("Unable to find user with id: $id");

        return $user;
    }

    /**
     * @throws ValidatorException
     * @throws ResourceNotFoundException
     */
    public function update($id, $data) : Model {
        $this->validate($data, $this->_updateRules);

        if (isset($data['password']))
            $data['password'] = Hash::make($data['password']);

        $user = $this->get($id);
        $user->update($data);

        return $this->get($user->id);
    }

    public function delete($id) : bool {
        $user = $this->get($id);
        return $user->delete();
    }
}
