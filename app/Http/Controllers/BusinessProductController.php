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
}
