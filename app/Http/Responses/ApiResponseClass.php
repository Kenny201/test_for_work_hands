<?php

namespace App\Http\Responses;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function throw($e, $message = "Что-то пошло не так!")
    {
        Log::info($e);
        throw new HttpResponseException(response()->json([
            'status' => false,
            "message" => $message,
        ], 500));
    }

    public static function notFound($e, $message = "Ресурс не найден")
    {
        Log::info($e);
        throw new HttpResponseException(response()->json([
            'status' => false,
            "message" => $message,
        ], 404));
    }

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'status' => true,
        ];

        $response = array_merge(get_object_vars($result->response()->getData()), $response);

        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}
