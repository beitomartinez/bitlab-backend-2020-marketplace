<?php

namespace App\Http\Controllers;

use App\Models\{Business, State};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $businesses = Business::inRandomOrder()->limit(3)->get([
            'name', 'slug', 'image'
        ]);

        $states = State::where('country_id', 90)->whereHas(
            'cities',
            function ($query) {
                $query->whereHas('businesses');
            }
        )->with([
            'cities' => function ($query) {
                $query->whereHas('businesses')->select(
                    ['id', 'name', 'state_id']
                );
            },
        ])->get(['id', 'name']);
        
        return view('home', compact('businesses', 'states'));
    }
}
