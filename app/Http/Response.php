<?php

namespace App\Http;

class Response
{
    public static function success($message, $status = 200, $extra = [], $token = null)
    {
        $header = [
            'Content-Type' => 'application/json; charset=UTF-8', 'Charset' => 'utf-8'
        ];

        if ($token) {
            $header['x-api-key'] = $token;
        }

        $response = collect([
            'status' => $status,
            'message' => $message,
        ])->merge($extra);


        return response()->json(
            $response,
            $status,
            $header,
            JSON_UNESCAPED_UNICODE
        );
    }

    public static function error($message, $status = 500, $extra = [])
    {
        $header = [
            'Content-Type' => 'application/json; charset=UTF-8', 'Charset' => 'utf-8'
        ];

        $response = collect([
            'status'   => $status, 'message'  => $message
        ])->merge($extra);

        return response()->json(
            $response,
            $status,
            $header,
            JSON_UNESCAPED_UNICODE
        );
    }
}
