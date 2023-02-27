<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Document $document)
    {
        UserDocument::firstOrCreate([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'is_activate' => 1
        ]);

        return redirect()->to(asset('storage/' . $document->path));
    }

    public function edit(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->read_all_docs = $request->all_docs;
        $user->save();

        return true;
    }
}
