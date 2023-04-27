<?php

namespace App\Exceptions;

use App\Http\Response;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResourceNotFoundException extends Exception
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

    public function render(Request $request): JsonResponse
    {
        return Response::error($this->getMessage(), 404);
    }
}
