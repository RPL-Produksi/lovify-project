<?php

namespace App\Http\Controllers\View\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientArticleController extends Controller
{
    public function index() {
        return view('pages.client.article_page.index');
    }
}
