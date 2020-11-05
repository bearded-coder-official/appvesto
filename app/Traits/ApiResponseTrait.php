<?php

namespace App\Traits;

use App\Support\ApiErrorCodes;

trait ApiResponseTrait
{
    public function error($category, $errorType, $extra = null)
    {
        return response()->json([
            'ErrorCode' => ApiErrorCodes::getError($category, $errorType),
            'ErrorCategory' => $category,
            'ErrorMessage' => $errorType,
            'Extra' => $extra,
        ], 422);
    }

    public function success($data)
    {
        return response()->json([
            'data' => $data,
        ], 200);
    }
}
