<?php

namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;

class UserService extends Service
{
    protected $_rules = [
        'username' => 'required|unique:users,username',
        'password' => 'required|min:8',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'city' => 'required',
        'zip' => 'required',
        'country' => 'required',
        'role' => 'required'
    ];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function all($pages = 10){
        return $this->_model->paginate($pages)->withQueryString();
    }

    public function find($id){
        return ["data" => $this->_model->find($id)];
    }

    public function add($data){

        $this->validate($data);
        if($this->hasErrors()){
            return;
        }

        $user = $this->_model->create($data);
        return $user;
    }

    public function update($id, $data){

        $this->validate($data);
        if($this->hasErrors()){
            return;
        }

        $user = $this->_model->find($id);
        $user = $this->_model->update($data);

        return $user;
    }

}
