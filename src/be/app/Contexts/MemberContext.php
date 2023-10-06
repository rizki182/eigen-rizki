<?php

namespace App\Contexts;

use Carbon\Carbon;
use App\Repositories\MemberRepository;

class MemberContext
{
    public static function list() {
        return MemberRepository::list();
    }
    
    public static function detail($id) {
        return MemberRepository::detail($id);
    }
}
