<?php

namespace App\Http\Controllers\View\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    public function profile() {
        return view('pages.client.profile.index');
    }
}
