<?php

namespace App\Contexts;

use Carbon\Carbon;
use App\Repositories\BookRepository;

class BookContext
{
    public static function list() {
        return BookRepository::list();
    }
    
    public static function detail($id) {
        return BookRepository::detail($id);
    }
}
