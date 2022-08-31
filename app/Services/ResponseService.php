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

    public static function json($data, $message, $status = 200)
    {
        $response["data"] = $data;
        $response["message"] = $message;
        return response()->json($response, $status);
    }
}
