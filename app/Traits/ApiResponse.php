<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Send a JSON response.
     *
     * @param  null  $data
     */
    public function response($status, $message, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function noContent()
    {
        return response()->noContent();
    }

    /**
     * Sends a JSON error response.
     *
     * @param  null  $errors
     */
    public function error($status, $message, $errors = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    /**
     * Handles an authorization error.
     *
     * @param  null  $message
     */
    public function authorizationError($message = null): JsonResponse
    {
        return response()->json('Authorization Failed', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Handles an authentication error.
     *
     * @param  null  $message
     */
    public function authenticationError($message = null): JsonResponse
    {
        return response()->json($message ?? 'Authentication Failed', Response::HTTP_FORBIDDEN);
    }

    /**
     * /*
     * Handles a validation error.
     */
    public function validationError($errors): JsonResponse
    {
        return $this->error(Response::HTTP_UNPROCESSABLE_ENTITY, 'Validation error', $errors);
    }

    /**
     * /*
     * Handles a custom error.
     *
     * @param  $errors
     */
    public function customError($message = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => null,
        ], Response::HTTP_FORBIDDEN);
    }

    /**
     * Handles a server error.
     */
    public function serverError(): JsonResponse
    {
        return $this->error(Response::HTTP_INTERNAL_SERVER_ERROR, 'Internal server error occurred');
    }
}
