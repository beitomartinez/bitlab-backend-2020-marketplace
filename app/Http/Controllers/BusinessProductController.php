<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;

class BusinessProductController extends Controller
{
    public function index(Request $request, int $businessId)
    {
        $business = Business::where('user_id', auth()->id())->findOrFail(
            $businessId
        );

        $products = Product::where('business_id', $businessId)->get();

        return view(
            'auth.businesses.products.index',
            compact('products', 'business')
        );
    }

    public function create(int $businessId)
    {
        $business = Business::where('user_id', auth()->id())->findOrFail(
            $businessId
        );

        return view('auth.businesses.products.create', compact('business'));
    }

    public function store(Request $request, int $businessId)
    {
        $business = Business::where('user_id', auth()->id())->findOrFail(
            $businessId
        );

        $request->validate([
            'name' => 'required|string|max:191',
            'image' => 'required|image|max:2048'
        ]);

        $product = new Product(['name' => $request->name]);
        $product->image = basename($request->image->store('products'));
        $product->business_id = $businessId;
        $product->save();

        return redirect()->route('my-businesses.products.index', $businessId);

    }
}
