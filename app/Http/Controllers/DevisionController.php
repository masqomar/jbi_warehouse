<?php

namespace App\Http\Controllers;


use App\Models\Devision;
use App\Http\Requests\{StoreDevisionRequest, UpdateDevisionRequest};
use Yajra\DataTables\Facades\DataTables;

class DevisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view devision')->only('index', 'show');
        $this->middleware('permission:create devision')->only('create', 'store');
        $this->middleware('permission:edit devision')->only('edit', 'update');
        $this->middleware('permission:delete devision')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            // $devisions = Devision::with('company:id,code')->where('company_id', auth()->user()->company_id);
            $devisions = Devision::with('company:id,code');

            return DataTables::of($devisions)
                ->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('action', 'devisions.include.action')
                ->toJson();
        }


        return view('devisions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devisions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDevisionRequest $request)
    {
        Devision::create($request->validated() + (['company_id' => auth()->user()->company_id]));

        return redirect()
            ->route('devisions.index')
            ->with('success', __('Devision created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function show(Devision $devision)
    {
        $devision->load('company:id,code');

        return view('devisions.show', compact('devision'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function edit(Devision $devision)
    {
        $devision->load('company:id,code');

        return view('devisions.edit', compact('devision'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDevisionRequest $request, Devision $devision)
    {
        $devision->update($request->validated() + (['company_id' => auth()->user()->company_id]));

        return redirect()
            ->route('devisions.index')
            ->with('success', __('Devision updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devision $devision)
    {
        try {
            $devision->delete();

            return redirect()
                ->route('devisions.index')
                ->with('success', __('Devision deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('devisions.index')
                ->with('error', __('The Devision can`t be deleted because it is related to another table.'));
        }
    }
}
