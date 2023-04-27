<?php

namespace App\Exceptions;

use App\Http\Response;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ValidatorException extends Exception
{

    private array | string $_errors;
    /**
     * Create a new CustomException instance.
     *
     * @param string $message
     * @param mixed $errors
     */
    public function __construct(string $message = "", $errors = null)
    {
        parent::__construct($message);

        if (is_null($errors)) {
            $this->_errors = $message;
        } else {
            $this->_errors = $errors;
        }
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    public function render(Request $request): JsonResponse
    {
        return Response::error($this->getErrors(), 400);
    }
}
