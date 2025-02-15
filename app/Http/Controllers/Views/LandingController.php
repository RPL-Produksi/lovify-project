<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function landing()
    {
        $vendor = Vendor::first();
        dd($vendor);
        $user = Auth::check() ? Auth::user() : null;

        if ($user) {
            $user["avatar"] = $user->avatar == null ? asset('avatars/default.png') : $user->avatar;
        }

        $category = Category::all();
        return view('pages.landing_page.index', compact('category', 'user'));
    }
}
