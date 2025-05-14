<?php

namespace App\Http\Controllers;
use App\Models\ExtraImage;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', ['images' => ExtraImage::all()]);
    }
}
