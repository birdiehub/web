<?php

namespace App\Modules\Core\Services;

use App\Exceptions\ValidatorException;
use App\Modules\Core\Validators\Validator;
use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    protected Model $_model;
    protected Validator $_validator;

    public function __construct(Model $model)
    {
        $this->_model = $model;
        $this->_validator = new Validator($this->_model);
    }

    /**
     * @param array $data
     *
     * @throws ValidatorException
     */
    protected function validate(array $data, array $rules): void
    {
        $this->_validator->validate($data, $rules);
    }
}
