<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperadminDashboardController extends Controller
{
    public function index() {
        return view('pages.superadmin.dashboard.index');
    }
}
