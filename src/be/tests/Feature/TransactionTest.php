<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_borrow_member(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/borrow/member/?id=1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "member" => [
                    "id",
                    "code",
                    "name",
                    "is_penalized",
                    "penalized_until",
                    "created_at",
                    "updated_at",
                    "book_units",
                ]
            ],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_borrow_book(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/borrow/book?id=1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "book_unit" => [
                    "id",
                    "book_id",
                    "code",
                    "status",
                    "borrowed_by",
                    "borrow_date",
                    "created_at",
                    "updated_at",
                    "book" => [
                        "id",
                        "code",
                        "title",
                        "author",
                        "stock",
                        "created_at",
                        "updated_at",                        
                    ]
                ]
            ],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_borrow(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->postJson("/api/transaction/borrow",[
            "member_id" => 1,
            "book_unit_ids" => [1,2]
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "member" => [
                    "id",
                    "code",
                    "name",
                    "is_penalized",
                    "penalized_until",
                    "created_at",
                    "updated_at",
                    "book_units",
                ]
            ],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }

    public function test_borrow_book_not_available(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/borrow/book?id=1");
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "status",
            "data",
            "message",
        ]);
        $response->assertJsonPath("status", false);
    }

    public function test_borrow_member_maxed_out(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/borrow/member/?id=1");
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "status",
            "data",
            "message",
        ]);
        $response->assertJsonPath("status", false);
    }

    // ----- return -----
    public function test_return_member(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/return/member/?id=1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "member" => [
                    "id",
                    "code",
                    "name",
                    "is_penalized",
                    "penalized_until",
                    "created_at",
                    "updated_at",
                    "book_units",
                ]
            ],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_return_book(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/return/book?book_unit_id=1&member_id=1");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "book_unit" => [
                    "id",
                    "book_id",
                    "code",
                    "status",
                    "borrowed_by",
                    "borrow_date",
                    "created_at",
                    "updated_at",
                    "book" => [
                        "id",
                        "code",
                        "title",
                        "author",
                        "stock",
                        "created_at",
                        "updated_at",                        
                    ]
                ]
            ],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }
    
    public function test_return(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->postJson("/api/transaction/return",[
            "member_id" => 1,
            "book_unit_ids" => [1,2]
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "data" => [
                "member" => [
                    "id",
                    "code",
                    "name",
                    "is_penalized",
                    "penalized_until",
                    "created_at",
                    "updated_at",
                    "book_units",
                ]
            ],
            "message",
        ]);
        $response->assertJsonPath("status", true);
    }

    public function test_return_book_not_borrowed(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/return/book?book_unit_id=1&member_id=1");
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "status",
            "data",
            "message",
        ]);
        $response->assertJsonPath("status", false);
    }

    public function test_return_member_not_borrowed_any_book(): void
    {
        $response = $this->withoutMiddleware(ThrottleRequests::class)->get("/api/transaction/return/member/?id=1");
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "status",
            "data",
            "message",
        ]);
        $response->assertJsonPath("status", false);
    }
}
