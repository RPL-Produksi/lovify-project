<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    public function profile() {
        return view('pages.client.profile');
    }
}
