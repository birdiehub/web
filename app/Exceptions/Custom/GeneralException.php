<?php

namespace App\Exceptions\Custom;

use App\Http\Response;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralException extends Exception
{

    /**
     * Create a new CustomException instance.
     *
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
