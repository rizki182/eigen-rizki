<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now('UTC');
        DB::table('books')->updateOrInsert([
            "code" => "JK-45",
            "title" => "Harry Potter",
            "author" => "J.K Rowling",
            "stock" => 2,
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('books')->updateOrInsert([
            "code" => "SHR-1",
            "title" => "A Study in Scarlet",
            "author" => "Arthur Conan Doyle",
            "stock" => 3,
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('books')->updateOrInsert([
            "code" => "TW-11",
            "title" => "Twilight",
            "author" => "Stephenie Meyer",
            "stock" => 2,
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('books')->updateOrInsert([
            "code" => "HOB-83",
            "title" => "The Hobbit, or There and Back Again",
            "author" => "J.R.R. Tolkien",
            "stock" => 1,
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('books')->updateOrInsert([
            "code" => "NRN-7",
            "title" => "The Lion, the Witch and the Wardrobe",
            "author" => "C.S. Lewis",
            "stock" => 4,
            "created_at" => $now,
            "updated_at" => $now,
        ]);
    }
}
