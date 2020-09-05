<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        return view(
            'admin.categories.index',
            [
                'categories' => Category::withCount('businesses')->get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'image' => 'required|image|max:2048'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'image' => basename($request->image->store('categories'))
        ]);

        return redirect()->route('admin.categories.show', $category->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) : View
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'image' => 'nullable|image|max:2048'
        ]);

        $category->fill($request->only('name'));

        if ($request->hasFile('image')) {
            $category->image = basename($request->image->store('categories'));
        }

        $category->save();

        return redirect()->route('admin.categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
