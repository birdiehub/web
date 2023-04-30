<?php

namespace App\Services\AccessControl;

use App\Services\Service;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
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

    public function create($data) : Model
    {
        Validator::standalone($data, $this->_insertRules);
        return parent::create($data);
    }

    public function find($name) : Model
    {
        return $this->model()->where('name', $name)->firstOrFail();
    }

    public function delete($name) : bool
    {
        $permission = $this->find($name);
        return $permission->delete();
    }

}
