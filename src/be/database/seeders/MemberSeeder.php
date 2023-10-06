<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now('UTC');
        DB::table('members')->updateOrInsert([
            "code" => "M001",
            "name" => "Angga",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('members')->updateOrInsert([
            "code" => "M002",
            "name" => "Ferry",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
        
        DB::table('members')->updateOrInsert([
            "code" => "M003",
            "name" => "Putri",
            "created_at" => $now,
            "updated_at" => $now,
        ]);
    }
}
