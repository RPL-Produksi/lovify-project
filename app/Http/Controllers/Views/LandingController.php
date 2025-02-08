<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function landing()
    {
        $user = Auth::user();
        $category = Category::all();
        return view('pages.landing_page.index', compact('category', 'user'));
    }
}
