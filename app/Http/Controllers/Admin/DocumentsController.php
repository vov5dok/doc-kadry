<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $documents = Document::all();

        return view('admin.documents.home', compact(['documents']));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'file_document' => 'required|file',
        ]);

        // ---- этот блок можно будет положить в services
        $data['file_document'] = Storage::disk('public')->put('/docs', $data['file_document']);

        Document::create([
            'name' => $data['name'],
            'path' => $data['file_document'],
        ]);
        // ----

        return redirect()->route('admin.documents.home');
    }

    public function delete(Document $document)
    {
        $document->delete();
        return redirect()->route('admin.documents.home');
    }

    public function edit(Document $document)
    {
        return view('admin.documents.edit', compact(['document']));
    }

    public function update(Request $request, Document $document)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'file_document' => '',
        ]);

        $data['file_document'] = $request->file_document != null
            ? Storage::disk('public')->put('/docs', $data['file_document'])
            : $document->path;

        $document->name = $data['name'];
        $document->path = $data['file_document'];
        $document->save();

        return redirect()->route('admin.documents.home');
    }
}
