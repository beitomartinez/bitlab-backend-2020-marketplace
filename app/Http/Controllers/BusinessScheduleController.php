<?php

namespace App\Http\Controllers;
use App\Models\{Business, Schedule};

use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessScheduleController extends Controller
{
    /**
     * Display a given business shcedules listing
     *
     * @param Request $request
     * @param integer $businessId
     * @return View
     */
    public function index(Request $request, int $businessId) : View
    {
        $business = Business::where('user_id', auth()->id())->with('schedules')
            ->findOrFail($businessId);

        return view('auth.businesses.schedules.index', compact('business'));
    }

    public function create(int $businessId)
    {
        $business = Business::where('user_id', auth()->id())->with('schedules')
            ->findOrFail($businessId);

        $allDays = ['m', 't', 'w', 'r', 'f', 's', 'u'];
        $takenDays = $business->schedules->pluck('day')->toArray();
        $availableDays = array_diff($allDays, $takenDays);
        
        return view(
            'auth.businesses.schedules.create',
            compact('business', 'availableDays')
        );
    }
}
