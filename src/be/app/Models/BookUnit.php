<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUnit extends Model
{
    use HasFactory;

    public function book(){
        return $this->belongsTo(Book::class);
    }
    
    public function member(){
        return $this->belongsTo(Member::class, "borrowed_by");
    }
}
