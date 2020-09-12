<?php

namespace App\Http\Controllers;

use App\Models\{Business};
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = Business::select(['id', 'name', 'slug', 'image']);

        if (!is_null($request->keyword)) {
            $query->where(
                function($subquery) use ($request) {
                    $subquery->where('name', 'like', "%$request->keyword%")
                        ->orWhere('description', 'like', "%$request->keyword%");
                }
            );
        }

        if (!is_null($request->city_id)) {
            $query->where('city_id', $request->city_id);
        }

        $businesses = $query->paginate(10);
        $businesses->appends($_GET);

        return view('businesses.index', compact('businesses'));
    }

    public function show(Request $request, string $slug) : View
    {
        $business = Business::where('slug', $slug)->firstOrFail();
        return view('businesses.show', compact('business'));
    }
}
