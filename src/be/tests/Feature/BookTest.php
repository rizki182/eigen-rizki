<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_book_list(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/book");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => ["book"],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_book_detail(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/book/1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => ["book"],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_book_detail_string_id(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/book/abc");
        $response->assertStatus(404);
    }
}
