<?php

namespace App\Modules\Core\Validators;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Validator
{
    protected Model $_model;
    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function validate(array $data, array $rules): void
    {

        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
