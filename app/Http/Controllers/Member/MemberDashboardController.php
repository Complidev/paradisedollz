<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MemberDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('member.dashboard');
    }
}
