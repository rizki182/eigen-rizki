<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\TransactionBorrowMemberGetRequest;
use App\Http\Requests\TransactionBorrowBookGetRequest;
use App\Http\Requests\TransactionBorrowPostRequest;
use App\Http\Requests\TransactionReturnMemberGetRequest;
use App\Http\Requests\TransactionReturnBookGetRequest;
use App\Http\Requests\TransactionReturnPostRequest;
use App\Contexts\TransactionContext;

use App\Helpers\ErrorHelper;

class TransactionController extends Controller
{
    public function borrow_member(TransactionBorrowMemberGetRequest $request) {
        try {
            // call context
            $data = TransactionContext::check_borrow_member($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function borrow_book(TransactionBorrowBookGetRequest $request) {
        try {
            // call context
            $data = TransactionContext::check_borrow_book($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function borrow(TransactionBorrowPostRequest $request) {
        DB::beginTransaction();
        try {
            // call context
            $data = TransactionContext::borrow($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            DB::commit();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function return_member(TransactionReturnMemberGetRequest $request) {
        try {
            // call context
            $data = TransactionContext::check_return_member($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function return_book(TransactionReturnBookGetRequest $request) {
        try {
            // call context
            $data = TransactionContext::check_return_book($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
    
    public function return(TransactionReturnPostRequest $request) {
        DB::beginTransaction();
        try {
            // call context
            $data = TransactionContext::return($request->all());
            // throw exception if status = false
            if(!$data["status"]) throw new \Exception($data["message"], 400);
            DB::commit();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ErrorHelper::generate_error_response($e);
            return response()->json($error["error"], $error["code"]);
        }
    }
}
