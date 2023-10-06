<?php

namespace App\Contexts;

use Carbon\Carbon;
use App\Repositories\MemberRepository;
use App\Repositories\BookUnitRepository;
use App\Repositories\BookRepository;

class TransactionContext
{
    public static function check_borrow_member($params) {
        return MemberRepository::check_borrow($params["id"], 0);
    }
    
    public static function check_borrow_book($params) {
        return BookUnitRepository::check_borrow($params["id"]);
    }
    
    public static function borrow($params) {
        $result = [];
        // check member
        $member = MemberRepository::check_borrow($params["member_id"], count($params["book_unit_ids"]));
        if(!$member["status"]) 
            return $member;
        $member = $member["data"];

        // update book unit
        $book_unit_array = [];
        foreach($params["book_unit_ids"] as $book_unit_id){
            $book_unit = BookUnitRepository::check_borrow($book_unit_id);
            if(!$book_unit["status"]) 
                return $book_unit;
            $book_unit = $book_unit["data"];
            
            BookUnitRepository::borrow($book_unit_id, $params["member_id"]);

            // update book stock
            BookRepository::borrow($book_unit["book_unit"]["book_id"], 1);
            $book_unit_array[] = $book_unit["book_unit"];
        }
        $data = [
            "id" => $member["member"]["id"],
            "code" => $member["member"]["code"],
            "name" => $member["member"]["name"],
            "is_penalized" => $member["member"]["is_penalized"],
            "penalized_until" => $member["member"]["penalized_until"],
            "created_at" => $member["member"]["created_at"],
            "updated_at" => $member["member"]["updated_at"],
            "book_units" => $book_unit_array,
        ];

        $result = [
            "status" => true,
            "data" => [
                "member" => $data,
            ],
            "message" => "success"
        ];
        return $result;
    }
    
    public static function check_return_member($params) {
        return MemberRepository::check_return($params["id"]);
    }
    
    public static function check_return_book($params) {
        return BookUnitRepository::check_return($params["book_unit_id"], $params["member_id"]);
    }
    
    public static function return($params) {
        $result = [];
        // check member
        $member = MemberRepository::check_return($params["member_id"]);
        if(!$member["status"]) 
            return $member;
        $member = $member["data"];

        // fetch book unit
        $book_unit_array = [];
        $test = [];
        $penalized = false;
        $now = Carbon::now('UTC')->timestamp;
        foreach($params["book_unit_ids"] as $book_unit_id){
            $book_unit = BookUnitRepository::check_return($book_unit_id, $params["member_id"]);
            if(!$book_unit["status"]) 
                return $book_unit;
            $book_unit = $book_unit["data"];
            
            // update book unit status
            BookUnitRepository::return($book_unit_id);
            // update book stock
            BookRepository::return($book_unit["book_unit"]["book_id"], 1);
            $book_unit_array[] = $book_unit["book_unit"];

            $borrowed_date = Carbon::parse($book_unit["book_unit"]["borrow_date"])->timestamp;
            $diff = abs($now - $borrowed_date)/60/60/24;
            if($diff > 7) $penalized = true;
        }

        // penalize member
        if($penalized) MemberRepository::penalized($member["member"]["id"], Carbon::now('UTC')->addDays(3)->format("Y-m-d H:i:s"));

        $data = [
            "id" => $member["member"]["id"],
            "code" => $member["member"]["code"],
            "name" => $member["member"]["name"],
            "is_penalized" => $member["member"]["is_penalized"],
            "penalized_until" => $member["member"]["penalized_until"],
            "created_at" => $member["member"]["created_at"],
            "updated_at" => $member["member"]["updated_at"],
            "book_units" => $book_unit_array,
        ];

        $result = [
            "status" => true,
            "data" => [
                "member" => $data,
            ],
            "message" => "success"
        ];
        return $result;
    }
}
