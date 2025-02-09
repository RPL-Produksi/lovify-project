<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function landing()
    {
        $user = Auth::check() ? Auth::user() : null;

        if ($user) {
            $folder = $user->avatar == null ? "avatars/default.png" : $user->avatar;
            $path = Storage::url($folder);
            $user["avatar"] = $path;
        }

        $category = Category::all();
        return view('pages.landing_page.index', compact('category', 'user'));
    }
}
