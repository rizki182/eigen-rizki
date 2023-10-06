<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookUnitTest extends TestCase
{
    public function test_book_unit_list(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/book/unit");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => ["book_unit"],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_book_unit_detail(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/book/unit/1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => ["book_unit"],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_book_unit_detail_string_id(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/book/unit/abc");
        $response->assertStatus(404);
    }
}
