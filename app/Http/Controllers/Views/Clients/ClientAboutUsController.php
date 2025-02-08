<?php

namespace App\Http\Controllers\views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAboutUsController extends Controller
{
    public function index() {
        return view('pages.client.about_us.index');
    }
}
