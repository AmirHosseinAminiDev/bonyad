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
        $doc = Documents::create([
            'major' => $request->get('major'),
            'education_level' => $request->get('education_level'),
            'job_status' => $request->get('job_status'),
            'job' => $request->get('job'),
            'job_type' => $request->get('job'),
            'birth_date' => $request->get('birth_date'),
            'address' => $request->get('address'),
            'marriage_status' => $request->get('marriage_status')
        ]);
        if ($request->has('war_document')) {
            $docName = $this->uploadDocument($request->file('war_history'), '/war_docs');
            $doc->update([
                'war_history' => $docName
            ]);
        }
        if ($request->has('active_basij')) {
            $docName = $this->uploadDocument($request->file('active_basij'), '/basij_docs');
            $doc->update([
                'active_basij' => $docName
            ]);
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

    protected function uploadDocument($file, $path)
    {
        $fileName = Str::random() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . $path, $fileName);
        return $fileName;
    }
}
