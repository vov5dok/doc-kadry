<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $documents = Document::all()->take(5);
        $users = User::all()->take(5);

        return view('admin.home', compact(['documents', 'users']));
    }
}
