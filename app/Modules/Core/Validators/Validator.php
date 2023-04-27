<?php

namespace App\Modules\Core\Validators;

use App\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\Model;

class Validator
{
    protected Model $_model;
    public function __construct(Model $model)
    {
        $this->_model = $model;
    }


    /**
     * @param array $data
     * @param array $rules
     *
     * @throws ValidatorException
     */
    public function validate(array $data, array $rules): void
    {

        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidatorException("Data validation failed", $validator->errors()->toArray());
        }
    }
}
