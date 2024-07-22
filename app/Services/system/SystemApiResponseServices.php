<?php

namespace App\Services\system;

class SystemApiResponseServices
{
    static public function ReturnSuccess(array $data, array|string|null $message, string|null $note)
    {
        return response()->json([
            "code" => 200,
            "data" => $data,
            "message" => $message,
            "note" => $note,
        ]);
    }
    static public function ReturnFailed(array $data, array|string|null $message, string|null $note)
    {
        return response()->json([
            "code" => 404,
            "data" => $data,
            "message" => $message,
            "note" => $note,
        ]);
    }
    static public function ReturnError(int $code, array|null $data, array|string|null $message, $note = null)
    {
        return response()->json([
            "code" => $code,
            "data" => $data,
            "message" => $message,
            "note" => $note,
        ]);
    }
}
