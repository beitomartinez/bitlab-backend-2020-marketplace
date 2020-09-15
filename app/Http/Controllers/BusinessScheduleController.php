<?php

namespace App\Http\Controllers;
use App\Models\{Business, Schedule};
use Illuminate\Http\RedirectResponse;
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

    /**
     * Display the schedule creation form
     *
     * @param integer $businessId
     * @return View
     */
    public function create(int $businessId) : View
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

    /**
     * Store a new schedule for a given business
     *
     * @param Request $request
     * @param integer $businessId
     * @return RedirectResponse
     */
    public function store(Request $request, int $businessId) : RedirectResponse
    {
        $business = Business::where('user_id', auth()->id())->with('schedules')
            ->findOrFail($businessId);

        $request->validate([
            'day' => 'required|string|in:m,t,w,r,f,s,u',
            'opens_at' => 'required|date_format:H:i',
            'closes_at' => 'required|date_format:H:i',
        ]);

        $takenDays = $business->schedules->pluck('day')->toArray();
        $isDayTaken = in_array($request->day, $takenDays);

        if ($isDayTaken) {
            abort(400);
        }

        $schedule = new Schedule($request->only(
            ['day', 'opens_at', 'closes_at']
        ));
        $schedule->business_id = $businessId;
        $schedule->save();

        return redirect()->route('my-businesses.schedules.index', $businessId);
    }

    /**
     * Display the edit form for a given schedule
     *
     * @param Request $request
     * @param integer $businessId
     * @param integer $scheduleId
     * @return View
     */
    public function show(
        Request $request,
        int $businessId,
        int $scheduleId
    ) : View {
        $business = Business::where('user_id', auth()->id())->with('schedules')
            ->findOrFail($businessId);
            
        $schedule = $business->schedules->where('id', $scheduleId)->first();

        if (is_null($schedule)) {
            abort(404);
        }

        $allDays = ['m', 't', 'w', 'r', 'f', 's', 'u'];
        $takenDays = $business->schedules->pluck('day')->toArray();
        $availableDays = array_diff($allDays, $takenDays);

        return view(
            'auth.businesses.schedules.show',
            compact('business', 'schedule', 'availableDays')
        );
    }

    public function update(
        Request $request,
        int $businessId,
        int $scheduleId
    ) : RedirectResponse {
        $business = Business::where('user_id', auth()->id())->with('schedules')
            ->findOrFail($businessId);
            
        $schedule = $business->schedules->where('id', $scheduleId)->first();

        if (is_null($schedule)) {
            abort(404);
        }

        $request->validate([
            'opens_at' => 'required|date_format:H:i',
            'closes_at' => 'required|date_format:H:i',
        ]);

        $schedule->update($request->only(['opens_at', 'closes_at']));

        return redirect()->route('my-businesses.schedules.index', $businessId);
    }
}
