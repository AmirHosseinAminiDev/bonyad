<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Enums\TeachersStatus;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'teacher' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
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
}
