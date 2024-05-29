<?php

namespace App\Http\Controllers\Admin\Universities;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.universities.index', [
            'universities' => University::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100|unique:universities'
        ], [
            'name.required' => 'نام دانشگاه اجباری میباشد',
            'name.unique' => 'دانشگاهی با این نام قبلا ثبت گردیده است',
            'name.string' => 'نام دانشگاه باید رشته باشد',
            'name.min' => 'نام دانشگاه حداقل باید 5 کاراکتر باشد',
            'name.max' => 'نام دانشگاه حداکثر باید 100 کاراکتر باشد',
        ]);
        University::create($request->only(['name']));
        return redirect()->route('universities.index')->with('success', 'دانشگاه مورد نظر با موفیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        return view('admin.universities.edit', [
            'university' => $university
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100', Rule::unique('universities')->ignore($university->id),
        ], [
            'name.required' => 'نام دانشگاه اجباری میباشد',
            'name.string' => 'نام دانشگاه باید رشته باشد',
            'name.min' => 'نام دانشگاه حداقل باید 5 کاراکتر باشد',
            'name.max' => 'نام دانشگاه حداکثر باید 100 کاراکتر باشد',
        ]);
        $university->update([
            'name' => $request->get('name')
        ]);
        return redirect()->route('universities.index')->with('success', 'بروز رسانی دانشگاه با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->classes();
        $university->delete();
        return redirect()->route('universities.index')->with('success', 'حذف دانشگاه با موفقیت انجام شد');
    }
}
