<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function landing()
    {
        return view('frontend.index');
    }

    public function register()
    {
        return view('frontend.register');
    }
}
