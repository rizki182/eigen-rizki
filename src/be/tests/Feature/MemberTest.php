<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberTest extends TestCase
{
    public function test_member_list(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/member");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => ["member"],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_member_detail(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/member/1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => ["member"],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_member_detail_string_id(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/member/abc");
        $response->assertStatus(404);
    }
}
