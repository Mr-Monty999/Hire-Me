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

    public static function JsonSuccess($data, $message)
    {
        $response["data"] = $data;
        $response["message"] = $message;
        $response["succuess"] = true;
        return response()->json($response);
    }
    public static function JsonError($data, $message)
    {
        $response["data"] = $data;
        $response["message"] = $message;
        $response["succuess"] = false;
        return response()->json($response);
    }
}
