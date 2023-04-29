<?php

namespace App\Services\AccessControl;

use App\Services\Service;
use App\Validators\Validator;
use Spatie\Permission\Models\Permission;

class PermissionService extends Service
{
    protected array $_insertRules = [
        'name' => ['required', 'string', 'regex:/^[a-z\-]+$/', 'unique:permissions,name']
    ];

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->_model->get();
    }

    public function list()
    {
        return $this->_model->get()->pluck('name');
    }

    public function create($data)
    {
        Validator::standalone($data, $this->_insertRules);
        return $this->_model->create($data);
    }

    public function get($name)
    {
        return $this->_model->where('name', $name)->firstOrFail();
    }

    public function delete($name)
    {
        $permission = $this->get($name);
        return $permission->delete();
    }

}
