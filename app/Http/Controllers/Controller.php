<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    public function isJson(Request $request)
    {
        return $request->header('Content-Type') == 'application/json';
    }
}
