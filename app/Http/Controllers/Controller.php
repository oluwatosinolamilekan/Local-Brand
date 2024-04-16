<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    //
    /**
     * @return JsonResponse
     */
    protected function resourceNotFound(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'resource not found'
        ],404);
    }

    /**
     * @return JsonResponse
     */
    protected function resourceDeleted(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully'
        ],200);
    }


    protected function resourceError($error): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => $error->getMessage()
        ],500);
    }
}
