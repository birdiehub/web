<?php

namespace App\Validators;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Validator
{

    private static function validate(array $data, array $rules): void
    {

        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public static function standalone(array $data, array $rules): void
    {
        self::validate($data, $rules);
    }

    public static function oneToOne(array $data, array $rules1, array $rules2, string $relationName): void
    {
        self::validate($data[$relationName] ?? [], $rules2);
        self::validate($data, $rules1);
    }

    public static function oneToMany(array $data, array $rules1, array $rules2, string $relationName) : void
    {
        foreach ($data[$relationName] ?? [] as $record) {
            self::validate($record, $rules2);
        }
        self::validate($data, $rules1);
    }

}
