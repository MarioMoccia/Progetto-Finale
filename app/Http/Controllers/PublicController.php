<?php

namespace App\Http\Controllers;

class PublicController extends Controller
{
    public function Homepage()
    {
        return view('homepage');
    }
}
