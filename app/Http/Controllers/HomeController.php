<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $documentActivate = [];
        $files = Document::all();
        $user = User::where('id', auth()->id())->first();
        $userDocuments = UserDocument::all()->where('user_id', auth()->id())->all();
        foreach ($userDocuments as $doc) {
            $documentActivate[$doc->document_id] = $doc->document_id;
        }
        return view('home', compact(['files', 'user', 'documentActivate']));
    }
}
