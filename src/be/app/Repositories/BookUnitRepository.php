<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\BookUnit;

class BookUnitRepository
{
    public static function list() {
        $book_unit = BookUnit::with(["book", "member"])->orderBy("id", "asc")->get();
        $result = [
            "status" => true,
            "data" => ["book_unit" => $book_unit],
            "message" => ""
        ];
        return $result;
    }
    
    public static function detail($id) {
        $book_unit = BookUnit::with(["book"])->where("id", $id)->first();
        $result = [
            "status" => true,
            "data" => ["book_unit" => $book_unit],
            "message" => ""
        ];
        return $result;
    }
    
    public static function check_borrow($id) {
        $result = [];

        $book_unit = BookUnit::with(["book"])
            ->where("id", $id)
            ->first();

        // return if book is not available
        if(!$book_unit) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "book (".$id.") is not found"
            ];

            return $result;
        } 
        // return if book is not available
        else if($book_unit->status != "available") {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "book (".$id.") is not available"
            ];
            return $result;
        }
        
        $result = [
            "status" => true,
            "data" => ["book_unit" => $book_unit],
            "message" => ""
        ];
        return $result;
    }

    public static function borrow($id, $member_id) {
        $result = [];
        BookUnit::where("id", $id)->update([
            "status" => "borrowed",
            "borrowed_by" => $member_id,
            "borrow_date" => Carbon::now('UTC'),
        ]);
        
        $result = [
            "status" => true,
            "data" => [],
            "message" => "success"
        ];
        return $result;
    }

    public static function check_return($id, $member_id) {
        $result = [];

        $book_unit = BookUnit::with(["book", "member"])
            ->where("id", $id)
            ->first();

        // return if book is not available
        if(!$book_unit) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "book (".$id.") is not found"
            ];

            return $result;
        } 
        else if($book_unit->status != "borrowed") {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "book (".$id.") is not borrowed"
            ];
            return $result;
        }

        if($book_unit->member->id != $member_id) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "book (".$id.") is not borrowed by this member (".$member_id.")"
            ];

            return $result;
        }
        
        $result = [
            "status" => true,
            "data" => ["book_unit" => $book_unit],
            "message" => ""
        ];
        return $result;
    }

    public static function return($id) {
        $result = [];
        // update book unit
        BookUnit::where("id", $id)->update([
            "status" => "available",
            "borrowed_by" => null,
            "borrow_date" => null,
        ]);
        
        $result = [
            "status" => true,
            "data" => [],
            "message" => "success"
        ];
        return $result;
    }
}
