<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contexts\MemberContext;

use App\Helpers\ErrorHelper;

class MemberController extends Controller
{
    public function list(Request $request) {
        try {
            $data = MemberContext::list($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function detail($id, Request $request) {
        try {
            $data = MemberContext::detail($id, $request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
}
