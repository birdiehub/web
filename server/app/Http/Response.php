<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class Response
{

    public static function ok(): JsonResponse
    {
        return self::json(["message" => "OK"]);
    }

    public static function error($errors = null, $code = 400) : JsonResponse
    {
        return response()->json([
            'failure' => $code,
            'cause' => $errors
        ], $code);
    }

    public static function json($json = null, $code = 200) : JsonResponse
    {
        return response()->json($json, $code);
    }
}
