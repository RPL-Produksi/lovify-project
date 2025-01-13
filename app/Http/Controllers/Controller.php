<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    public function makeSlug($name)
    {
        $toLower = strtolower($name);
        $slug = str_replace([' ', '/'], '-', $toLower);

        return $slug;
    }
}
