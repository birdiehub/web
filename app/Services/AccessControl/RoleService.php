<?php

namespace App\Services\AccessControl;

use App\Services\Service;
use App\Validators\Validator;
use Exception;
use Spatie\Permission\Models\Role;

class RoleService extends Service
{
    protected array $_insertRules = [
        'name' => ['required', 'string', 'regex:/^[a-z\-]+$/', 'unique:roles,name']
    ];

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->_model->get();
    }

    public function list()
    {
        return $this->_model->get()->pluck("name");
    }

    public function create($data)
    {
        Validator::standalone($data, $this->_insertRules);
        $role = $this->_model->create($data);
        return $role;
    }

    public function get($name)
    {
        return $this->_model
            ->with("permissions")
            ->where("name", $name)
            ->firstOrFail();
    }

    public function delete($name)
    {
        $role = $this->get($name);
        return $role->delete();
    }
    public function grantPermission($roleName, $permissionName): void
    {
        $role = $this->get($roleName);
        $role->givePermissionTo($permissionName);
    }

    public function revokePermission($roleName, $permissionName): void
    {
        $role = $this->get($roleName);
        $role->revokePermissionTo($permissionName);
    }

}
