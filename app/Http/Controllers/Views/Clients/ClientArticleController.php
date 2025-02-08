<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientArticleController extends Controller
{
    public function index() {
        return view('pages.client.article_page.index');
    }
}
