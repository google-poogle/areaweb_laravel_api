<?php

use Illuminate\Http\JsonResponse;

function responseFailed(string $message = null, int $code = 400): JsonResponse
{
    return response()->json([
        'message' => __($message) ?? __('Bad request'),
    ], $code);
}

function getModelNotFoundMessage(string $model): string
{
    return match ($model) {
        'App\Models\User' => __('User not found'),
        default => __('Entity not found')
    };
}
