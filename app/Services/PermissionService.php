<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionService extends Service
{

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function find($name) : Model
    {
        return $this->model()->where('name', $name)->firstOrFail();
    }

}
