<?php

namespace App\Http\Controllers;



trait ApiResponseTrait
{
    protected function successResponse($data, $message = null, $code = 200){
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ],$code);
    }
    protected function errorResponse($message = null, $code = 422, $error = null){
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $error
        ],$code);
    }
}
