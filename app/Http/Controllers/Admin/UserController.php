<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display and search in the users listing
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $query = User::withTrashed()->withCount('businesses');

        if ($request->has('name') && !is_null($request->name)) {
            $query->where('name', 'like', "%$request->name%");
        }
        
        if ($request->has('email') && !is_null($request->email)) {
            $query->where('email', 'like', "%$request->email%");
        }
        
        if ($request->has('is_admin')) {
            $query->where('is_admin', $request->is_admin);
        }
        
        if ($request->has('is_active')) {
            if ($request->is_active == 1) {
                $query->whereNull('deleted_at');
            } else {
                $query->whereNotNull('deleted_at');
            }
        }



        $users = $query->get();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Display a given user
     *
     * @param integer $id
     * @return View
     */
    public function show(int $id) : View
    {
        $user = User::withTrashed()->where('id', '!=', auth()->id())
            ->findOrFail($id);

        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * (Soft) Delete a given user
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users.show', $user->id);
    }

    /**
     * Restore a (soft) deleted user
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function restore(int $id) : RedirectResponse
    {
        User::withTrashed()->where('id', $id)->restore();
        return back();
    }
}
