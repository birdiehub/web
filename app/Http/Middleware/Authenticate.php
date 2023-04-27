<?php

namespace App\Http\Middleware;

use App\Exceptions\ForbiddenAccessException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    /**
     * Handle an unauthenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     *
     * @throws ForbiddenAccessException
     */

    protected function unauthenticated($request, array $guards): void
    {
        throw new ForbiddenAccessException("You are not authorized to access this resource.");
    }
}
