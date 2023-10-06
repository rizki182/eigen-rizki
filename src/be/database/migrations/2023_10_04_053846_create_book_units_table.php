<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_units', function (Blueprint $table) {
            $table->id();
            $table->integer("book_id");
            $table->string("code", 20)->unique();
            $table->string("status", 50)->default("available");
            $table->integer("borrowed_by")->nullable();
            $table->datetime("borrow_date")->nullable();
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('borrowed_by')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_units');
    }
};
