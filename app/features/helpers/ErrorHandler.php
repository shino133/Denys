<?php
class ErrorHandler
{
    private static $message = "";
    private static $code = 500;


    public static function set($message, $statusCode = 500): void
    {
        self::$message = $message;
        self::$code = $statusCode;
    }

    public static function get()
    {
        return [
            'status' => 'error',
            'code' => self::$code ?? 500,
            'message' => self::$message ?? 'Unknown Server Error',
        ];
    }
    
    
    public static function sendJson($exit = true): bool|string
    {
        $res = [
            'status' => 'error',
            'code' => self::$code ?? 500,
            'message' => self::$message ?? 'Unknown Server Error',
        ];
        
        http_response_code($res['code']);
        header('Content-Type: application/json');

        if ($exit) {
            exit(json_encode($res));
        }

        return json_encode($res);
    }
}
