<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Member;

class MemberRepository
{
    public static function list() {
        $member = Member::with(["bookUnits"])->orderBy("id", "asc")->get();
        $result = [
            "status" => true,
            "data" => ["member" => $member],
            "message" => ""
        ];
        return $result;
    }
    
    public static function detail($id) {
        $member = Member::with(["bookUnits"])->find($id);
        $result = [
            "status" => true,
            "data" => ["member" => $member],
            "message" => ""
        ];
        return $result;
    }

    public static function check_borrow($id, $new_book_count) {
        $new_book_count = $new_book_count == 0 ? 1 : $new_book_count;
        $result = [];

        // get member
        $member = Member::with(["bookUnits"])
            ->where("id", $id)
            ->first();

        // check for not found
        if(!$member) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "member (".$id.") is not found"
            ];

            return $result;
        } 
        // check if member is penalized
        else if($member->is_penalized) {
            $now = Carbon::now('UTC')->timestamp;
            $penalized_until = Carbon::parse($member->penalized_until)->timestamp;
            if(($now - $penalized_until) > 0) {
                MemberRepository::clear_penalty($member->id);
            } else {
                $result = [
                    "status" => false,
                    "data" => [],
                    "message" => "member (".$id.") is penalized"
                ];
                return $result;
            }

        }
        
        // check if member already maxed out
        if(count($member->bookUnits) + $new_book_count > 2) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "Can't borrow more than 2 book"
            ];
            return $result;
        }
        
        // success response
        $result = [
            "status" => true,
            "data" => [
                "member" => $member,
            ],
            "message" => ""
        ];

        return $result;
    }
    
    public static function check_return($id) {
        $result = [];

        $member = Member::with(["bookUnits.book"])
            ->where("id", $id)
            ->first();

        // not found
        if(!$member) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "member (".$id.") is not found"
            ];

            return $result;
        }
        // member not borrowing book
        else if(count($member->bookUnits) == 0) {
            $result = [
                "status" => false,
                "data" => [],
                "message" => "member (".$id.") is not borrowing any book"
            ];

            return $result;
        }
        
        $result = [
            "status" => true,
            "data" => [
                "member" => $member,
            ],
            "message" => ""
        ];

        return $result;
    }
    
    public static function penalized($id, $penalize_until) {
        $result = [];

        $member = Member::where("id", $id)->update([
            "is_penalized" => true,
            "penalized_until" => $penalize_until
        ]);
        
        $result = [
            "status" => true,
            "data" => [
                "member" => $member,
            ],
            "message" => ""
        ];

        return $result;
    }
    
    public static function clear_penalty($id) {
        $result = [];

        $member = Member::where("id", $id)->update([
            "is_penalized" => false,
            "penalized_until" => null
        ]);
        
        $result = [
            "status" => true,
            "data" => [
                "member" => $member,
            ],
            "message" => ""
        ];

        return $result;
    }
}
