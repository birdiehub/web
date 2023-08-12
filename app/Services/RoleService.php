<?php

namespace App\Services;

use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
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

    public function create($data) : Model
    {
        Validator::standalone($data, $this->_insertRules);
        return parent::create($data);
    }

    public function find($name) : Model
    {
        return $this->model()
            ->where("name", $name)
            ->firstOrFail();
    }

    public function delete($name) : bool
    {
        $role = $this->find($name);
        return $role->delete();
    }
    public function grantPermission($roleName, $permissionName): void
    {
        $role = $this->find($roleName);
        $role->givePermissionTo($permissionName);
    }

    public function revokePermission($roleName, $permissionName): void
    {
        $role = $this->find($roleName);
        $role->revokePermissionTo($permissionName);
    }

}
