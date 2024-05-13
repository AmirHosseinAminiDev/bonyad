<?php

namespace App\Http\Controllers\Admin\ClassRooms;

use App\Enums\TeachersStatus;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Teacher;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.classrooms.index', [
            'classes' => ClassRoom::with(['teacher', 'university'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classrooms.create', [
            'teachers' => Teacher::where('status', TeachersStatus::ACTIVE->value)->get(),
            'universities' => University::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $startDate = $this->convertDate($request->get('start_date'));
        $endDate = $this->convertDate($request->get('end_date'));
        if ($startDate > $endDate || $endDate > Carbon::now() || $startDate > Carbon::now()) {
            return redirect()->back()->with('error', 'تاریخ مذکور معتبر نمیباشد');
        }
        ClassRoom::create([
            'university_id' => $request->get('university'),
            'teacher_id' => $request->get('teacher'),
            'name' => $request->get('name'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'boys' => $request->get('boys'),
            'girls' => $request->get('girls'),
        ]);
        return redirect()->route('classes.index')->with('success', 'کلاس با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        return view('admin.classrooms.edit', [
            'teachers' => Teacher::where('status', TeachersStatus::ACTIVE->value)->get(),
            'universities' => University::all(),
            'class' => $classRoom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        $startDate = $this->convertDate($request->get('start_date'));
        $endDate = $this->convertDate($request->get('end_date'));
        if ($startDate > $endDate || $endDate > Carbon::now() || $startDate > Carbon::now()) {
            return redirect()->back()->with('error', 'تاریخ مذکور معتبر نمیباشد');
        }
        $classRoom->update([
            'university_id' => $request->get('university'),
            'teacher_id' => $request->get('teacher'),
            'name' => $request->get('name'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'boys' => $request->get('boys'),
            'girls' => $request->get('girls'),
        ]);
        return redirect()->route('classes.index')->with('success', 'کلاس با موفقیت بروز رسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        return redirect()->route('classes.index')->with('success', 'کلاس با موفقیت حذف شد');
    }

    protected function convertDate($date)
    {
        $dateString = CalendarUtils::convertNumbers(str_replace('/', '-', $date), true);
        $latinDate = Jalalian::fromFormat('Y-m-d', $dateString)->toCarbon()->toDateString();
        return $latinDate;
    }
}
