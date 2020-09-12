<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $businesses = Business::inRandomOrder()->limit(3)->get([
            'name', 'slug', 'image'
        ]);
        return view('home', compact('businesses'));
    }
}
