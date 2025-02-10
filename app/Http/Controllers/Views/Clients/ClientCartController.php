<?php

namespace App\Http\Controllers\View\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    public function cart() {
        return view('pages.client.cart.index');
    }
}
