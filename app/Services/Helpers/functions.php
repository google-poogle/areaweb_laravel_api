<?php

use Illuminate\Http\JsonResponse;

function responseOk(): Illuminate\Http\JsonResponse
{
    return response()->json([
        'status' => 'success',
    ]);
}

function responseFailed(string $message = null, int $code = 400): JsonResponse
{
    return response()->json([
        'message' => $message,
    ], $code);
}

function getMessage(string $code = null): ?string
{
    return __("messages.$code");
}
