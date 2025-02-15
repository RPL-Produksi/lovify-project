<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientArticleController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages.client.article_page.index', compact('user'));
    }
}
