<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now('UTC');
        DB::table('book_units')->updateOrInsert([
            "book_id" => 1,
            "code" => "JK-45-001",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 1,
            "code" => "JK-45-002",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 2,
            "code" => "SHR-1-001",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 2,
            "code" => "SHR-1-002",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 2,
            "code" => "SHR-1-003",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 3,
            "code" => "TW-11-001",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 3,
            "code" => "TW-11-002",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 4,
            "code" => "HOB-83-001",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 5,
            "code" => "NRN-7-001",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 5,
            "code" => "NRN-7-002",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 5,
            "code" => "NRN-7-003",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('book_units')->updateOrInsert([
            "book_id" => 5,
            "code" => "NRN-7-004",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
    }
}
