<?php

namespace App\Http\Controllers\Admin\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doc = documentService()->createDocumnet($request->all());
        if ($request->has('war_document')) {
            $file = $request->file('war_history');
            $warPath = '/war_history';
            documentService()->upload($doc, $file, $warPath);
        }
        if ($request->has('active_basij')) {
            $file = $request->file('active_basij');
            $basijPath = '/active_basij';
            documentService()->upload($doc, $file, $basijPath);
        }
        return redirect()->back()->with('success', 'مدارک با موفقیت آپلود شدند');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documents $documents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $documents)
    {
        //
    }
}
