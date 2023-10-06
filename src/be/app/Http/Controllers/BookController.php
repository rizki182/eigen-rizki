<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contexts\BookContext;

use App\Helpers\ErrorHelper;

class BookController extends Controller
{
    public function list(Request $request) {
        try {
            // call context
            $data = BookContext::list($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function detail($id) {
        try {
            // call context
            $data = BookContext::detail($id);
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
}
