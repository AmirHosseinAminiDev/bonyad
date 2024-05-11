<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->national_code = $request->get('national_code');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->back()->with('success', 'کاربر مورد نظر ثبت شد');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $data = [
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'national_code' => $request->get('national_code'),
            'email' => $request->get('email'),
        ];
        if ($request->has('password')) {
            $user->update(array_merge($data, [
                'password' => bcrypt($request->get('password'))
            ]));
        }
        $user->update($data);
        return redirect()->back()->with('success', 'کاربر مورد نظر بروز رسانی شد');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if (auth()->user()->id == $user->id) {
            Auth::logout();
        }
        $user->delete();
        return redirect()->back()->with('success', 'کاربر مورد نظر حذف شد');
    }
}
