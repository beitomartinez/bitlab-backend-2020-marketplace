<?php

namespace App\Http\Controllers;

use App\Models\{Business};
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        
    }

    public function show(Request $request, string $slug) : View
    {
        $business = Business::where('slug', $slug)->firstOrFail();
        return view('businesses.show', compact('business'));
    }
}
