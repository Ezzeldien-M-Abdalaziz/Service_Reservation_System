<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }


}
