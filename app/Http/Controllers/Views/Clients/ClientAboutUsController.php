<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientAboutUsController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages.client.about_us.index', compact('user'));
    }
}
