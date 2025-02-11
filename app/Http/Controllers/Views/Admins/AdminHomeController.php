<?php

namespace App\Http\Controllers\Views\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function home()
    {
        return view('pages.admin.home.index');
    }
}
