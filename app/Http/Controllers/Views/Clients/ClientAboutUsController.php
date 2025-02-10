<?php

namespace App\Http\Controllers\views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientAboutUsController extends Controller
{
    public function index() {
        $user = Auth::check() ? Auth::user() : null;

        if ($user) {
            $folder = $user->avatar == null ? "avatars/default.png" : $user->avatar;
            $path = Storage::url($folder);
            $user["avatar"] = $path;
        }
        return view('pages.client.about_us.index', compact('user'));
    }
}
