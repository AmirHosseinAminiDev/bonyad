<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Enums\RequestsStatus;
use App\Enums\TeachersStatus;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.teachers.index', [
            'teachers' => Teacher::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create', [
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $userObj = $this->findUser($request->get('user'));
        if ($userObj->masterRequest) {
            return redirect()->back()->with('error', 'کاربر مورد نظر درحال حاضر برای انتصاب به عنوان استاد درخواست خود را ارسال کرده است');
        }

        if ($user->is_admin == 1)
        {
            return redirect()->route('users.index')->with('error','کاربر مورد نظر مدیر میباشد و نمیتواند به عنوان استاد انتخاب گردد');
        }
        $docData = [
            'major' => $request->get('major'),
            'education_level' => $request->get('education_level'),
            'job_status' => $request->get('job_status'),
            'job' => $request->get('job'),
            'job_type' => $request->get('job_type'),
            'birth_date' => $request->get('birth_date'),
            'address' => $request->get('address'),
            'marriage_status' => $request->get('marriage_status'),
            'children_count' => $request->get('children_count'),
        ];
        $doc = documentService()->createDocument($docData);
        if (!is_null($request->file('war_history'))) {
            $file = $request->file('war_history');
            $warPath = '/war_history';
            documentService()->upload($doc, $file, $warPath);
        }
        if (!is_null($request->file('active_basij'))) {
            $file = $request->file('active_basij');
            $basijPath = '/active_basij';
            documentService()->upload($doc, $file, $basijPath);
        }

        $requestObj = $userObj->masterRequest()->create([
            'document_id' => $doc->id,
            'status' => RequestsStatus::ACCEPTED
        ]);
        $userObj->teacher()->create([
            'status' => TeachersStatus::ACTIVE
        ]);
        return redirect()->route('teachers.index')->with('success', 'استاد با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', [
            'teacher' => $teacher,
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $userObj = $this->findUser($request->get('user'));
        $docData = [
            'major' => $request->get('major'),
            'education_level' => $request->get('education_level'),
            'job_status' => $request->get('job_status'),
            'job' => $request->get('job'),
            'job_type' => $request->get('job_type'),
            'birth_date' => $request->get('birth_date'),
            'address' => $request->get('address'),
            'marriage_status' => $request->get('marriage_status'),
            'children_count' => $request->get('children_count'),
        ];
        $doc = documentService()->updateDocument($teacher->user->masterRequest->document, $docData);
        if (!is_null($request->file('war_history'))) {
            if (!empty($doc->war_document) || !is_null($doc->war_document)) {
                $filePath = public_path() . '/war_history';
                unlink($filePath . '/' . $doc->war_document);
            }
            $file = $request->file('war_history');
            $warPath = '/war_history';
            documentService()->upload($doc, $file, $warPath);
        }
        if (!is_null($request->file('active_basij'))) {
            if (!empty($doc->active_basij) || !is_null($doc->active_basij)) {
                $filePath = public_path() . '/active_basij';
                unlink($filePath . '/' . $doc->active_basij);
            }
            $file = $request->file('active_basij');
            $basijPath = '/active_basij';
            documentService()->upload($doc, $file, $basijPath);
        }

        $requestObj = $userObj->masterRequest()->update([
            'document_id' => $doc->id,
            'status' => RequestsStatus::ACCEPTED
        ]);
        $teacher->update([
            'user_id' => $userObj->id,
            'status' => TeachersStatus::ACTIVE
        ]);
        return redirect()->route('teachers.index')->with('success', 'استاد با موفقیت بروز رسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher): RedirectResponse
    {
        $teacher->classes()->delete();
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'استاد با موفقیت حذف شد');
    }

    public function status(Teacher $teacher)
    {
        if ($teacher->status == TeachersStatus::ACTIVE->value) {
            $teacher->update([
                'status' => TeachersStatus::INACTIVE->value
            ]);
        } elseif ($teacher->status == TeachersStatus::INACTIVE->value) {
            $teacher->update([
                'status' => TeachersStatus::ACTIVE
            ]);
        }

        return redirect()->back()->with('success', 'استاد با موفقیت بروز رسانی شد');
    }

    protected function findUser($user)
    {
        return User::where('id', $user)->first();
    }
}
