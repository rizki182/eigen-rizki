<?php

namespace App\Contexts;

use Carbon\Carbon;
use App\Repositories\BookUnitRepository;

class BookUnitContext
{
    public static function list() {
        return BookUnitRepository::list();
    }
    
    public static function detail($id) {
        return BookUnitRepository::detail($id);
    }
}
