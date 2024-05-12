<?php

namespace App\Http\Controllers\Admin\MasterRequests;

use App\Enums\RequestsStatus;
use App\Http\Controllers\Controller;
use App\Models\MasterRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MasterRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->has('type'))
        {
            if ($request->get('type') == RequestsStatus::ALL->value)
            {
                return view('admin.requests.index', [
                    'requests' => MasterRequest::all()
                ]);
            }
            return  view('admin.requests.index',[
                'requests' => MasterRequest::where('status',$request->get('type'))->get()
            ]);
        }
        return view('admin.requests.index', [
            'requests' => MasterRequest::all()
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
    public function show(MasterRequest $masterRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterRequest $masterRequest)
    {
        return view('admin.requests.edit', [
            'master' => $masterRequest
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterRequest $masterRequest)
    {
        if ($request->result == RequestsStatus::ACCEPTED->value) {
            $masterRequest->update([
                'status' => RequestsStatus::ACCEPTED->value
            ]);
        } elseif ($request->result == RequestsStatus::REJECTED->value) {
            $masterRequest->update([
                'status' => RequestsStatus::REJECTED->value
            ]);
        } else {
            $masterRequest->update([
                'status' => RequestsStatus::INPROGRESS->value
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'وضعیت درخواست مورد نظر بروز رسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterRequest $masterRequest)
    {
        //
    }
}
