<?php

namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('pages.client.home.index');
    }
}
