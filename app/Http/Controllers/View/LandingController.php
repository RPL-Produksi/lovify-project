<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing()
    {
        $category = Category::all();
        return view('pages.landing_page.index', compact('category'));
    }
}
