<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientProfileController extends Controller
{
    public function profile() {
        $user = Auth::user();
       
        return view('pages.client.profile.index', compact('user'));
    }
}
