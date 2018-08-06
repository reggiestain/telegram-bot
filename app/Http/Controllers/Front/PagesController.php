<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller {

    public function login() {
        return view('front.pages.login');
    }
    
    public function register() {
        return view('front.pages.register');
    }

}
