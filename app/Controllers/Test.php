<?php

namespace App\Controllers;

class Test extends BaseController
{
    // Page "Hello World"
    public function hello()
    {
        return view('hello_world');
    }

    // Page "About"
    public function about()
    {
        return view('about');
    }

    // Page "Contact"
    public function contact()
    {
        return view('contact');
    }
}