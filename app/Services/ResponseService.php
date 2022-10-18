<?php

namespace App\Services;


class ResponseService
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function json($data = null, $message = null, $status = 200)
    {
        $response["data"] = $data;
        $response["message"] = $message;
        // $data["message"] = $message;
        return response()->json($response, $status);
    }
}
