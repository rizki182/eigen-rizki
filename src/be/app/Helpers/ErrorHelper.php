<?php
namespace App\Helpers;

class ErrorHelper{
    static function generate_error_response($e){
        $result = [];
        if($e->getCode() == 400) {
            $result = [
                "code" => 400,
                "error" => [
                    "status" => false,
                    "data" => [],
                    "message" => $e->getMessage(),
                ]
            ];
        } else {
            $result = [
                "code" => 500,
                "error" => [
                    "status" => false,
                    "data" => [],
                    "message" => "Something went wrong",
                ]
            ];
        }
        return $result;
    }
}
