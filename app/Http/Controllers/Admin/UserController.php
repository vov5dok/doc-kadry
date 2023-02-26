<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.home', compact(['users']));
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.home');
    }


}
