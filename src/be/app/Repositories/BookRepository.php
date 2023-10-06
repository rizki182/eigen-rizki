<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Book;

class BookRepository
{
    public static function list() {
        $book = Book::orderBy("id", "asc")->get();
        $result = [
            "status" => true,
            "data" => ["book" => $book],
            "message" => ""
        ];
        return $result;
    }
    
    public static function detail($id) {
        $book = Book::with(["bookUnits.member"])->where("id", $id)->first();
        $result = [
            "status" => true,
            "data" => ["book" => $book],
            "message" => ""
        ];
        return $result;
    }

    public static function return($id, $value) {
        $book = Book::where("id", $id)->increment('stock', $value);
    }
    
    public static function borrow($id, $value) {
        $book = Book::where("id", $id)->decrement('stock', $value);
    }
}
