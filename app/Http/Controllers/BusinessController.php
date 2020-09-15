<?php

namespace App\Http\Controllers;

use App\Models\{Business};
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = Business::select(['id', 'name', 'slug', 'image'])->with(
            'products:name,business_id'
        );

        if (!is_null($request->keyword)) {
            $query->where(
                function($subquery) use ($request) {
                    $subquery->where('name', 'like', "%$request->keyword%")
                        ->orWhere('description', 'like', "%$request->keyword%")
                        ->orWhereHas(
                            'products',
                            function ($productsQuery) use ($request) {
                                $productsQuery->where(
                                    'name',
                                    'like',
                                    "%$request->keyword%"
                                );
                            }
                        );
                }
            );
        }

        if (!is_null($request->city_id)) {
            $query->where('city_id', $request->city_id);
        }


        if ($request->has('open_now')) {
            $allDays = ['m', 't', 'w', 'r', 'f', 's', 'u'];
            $today = $allDays[date('N') - 1];
            $time = date('H:i:00');

            $query->whereHas(
                'schedules',
                function ($query) use ($today, $time) {
                    $query->where([
                        ['day', $today],
                        ['opens_at', '<=', $time],
                        ['closes_at', '>', $time],
                    ]);
                }
            );
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
