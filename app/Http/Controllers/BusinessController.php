<?php

namespace App\Http\Controllers;

use App\Models\{Business, Category, City, State};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display business create form
     *
     * @return View
     */
    public function create() : View
    {
        $categories = Category::get(['id', 'name']);
        $states = State::with('cities:id,name,state_id')->where(
            'country_id',
            90
        )->get(['id', 'name']);

        return view('businesses.create', compact('categories', 'states'));
    }

    /**
     * Store a new business
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'phone' => 'nullable|string|max:9|min:8',
            'whatsapp' => 'nullable|string|max:9|min:8',
            'email' => 'nullable|email|max:191',
            'website' => 'nullable|string|max:191',
            'address' => 'required|string|max:191',
            'city_id' => 'required|int',
            'category_id' => 'required|int',
            'is_delivery' => 'required|boolean',
            'is_takeout' => 'required|boolean',
        ]);

        $newBusiness = new Business($request->only([
            'name',
            'description',
            'phone',
            'whatsapp',
            'email',
            'website',
            'address',
            'is_delivery',
            'is_takeout',
            'city_id',
            'category_id',
        ]));

        $city = City::select('id', 'state_id')->find($request->city_id);
        if (is_null($city)) {
            abort(400);
        }
        $newBusiness->state_id = $city->state_id;
        $newBusiness->user_id = auth()->id();
        
        $newBusiness->image = basename($request->image->store('businesses'));
        $newBusiness->save();

        return redirect()->route('businesses.edit', $newBusiness->id);
    }

    /**
     * Display business edit form
     *
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function edit(Request $request, int $id) : View
    {
        $business = Business::where('user_id', auth()->id())->findOrFail($id);
        $categories = Category::get(['id', 'name']);
        $states = State::with('cities:id,name,state_id')->where(
            'country_id',
            90
        )->get(['id', 'name']);

        return view(
            'businesses.edit',
            compact('business', 'categories', 'states')
        );
    }

    /**
     * Update a given business
     *
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id) : RedirectResponse
    {
        $business = Business::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:9|min:8',
            'whatsapp' => 'nullable|string|max:9|min:8',
            'email' => 'nullable|email|max:191',
            'website' => 'nullable|string|max:191',
            'address' => 'required|string|max:191',
            'city_id' => 'required|int',
            'category_id' => 'required|int',
            'is_delivery' => 'required|boolean',
            'is_takeout' => 'required|boolean',
        ]);

        $business->fill($request->only([
            'name',
            'description',
            'phone',
            'whatsapp',
            'email',
            'website',
            'address',
            'is_delivery',
            'is_takeout',
            'city_id',
            'category_id',
        ]));

        $city = City::select('id', 'state_id')->find($request->city_id);
        if (is_null($city)) {
            abort(400);
        }

        $business->state_id = $city->state_id;
        
        if ($request->has('image')) {
            $business->image = basename($request->image->store('businesses'));
        }

        $business->save();

        return redirect()->route('businesses.edit', $business->id);
    }

    public function show(string $slug)
    {
        $business = Business::where('slug', $slug)->firstOrFail();
        return view('businesses.show', compact('business'));
    }
}
