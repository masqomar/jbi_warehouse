<?php

namespace App\Http\Controllers;


use App\Models\Electricity;
use App\Http\Requests\{StoreElectricityRequest, UpdateElectricityRequest};
use App\Models\Building;
use Yajra\DataTables\Facades\DataTables;

class ElectricityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view electricity')->only('index', 'show');
        $this->middleware('permission:create electricity')->only('create', 'store');
        $this->middleware('permission:edit electricity')->only('edit', 'update');
        $this->middleware('permission:delete electricity')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $electricities = Electricity::with('building:id,name', 'company:id,name')
                ->where('company_id', auth()->user()->company_id);

            return DataTables::of($electricities)
                ->addColumn('note', function ($row) {
                    return str($row->note)->limit(200);
                })
                ->addColumn('extra_note', function ($row) {
                    return str($row->extra_note)->limit(200);
                })
                ->addColumn('building', function ($row) {
                    return $row->building ? $row->building->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->name : '-';
                })->addColumn('action', 'electricities.include.action')
                ->toJson();
        }

        return view('electricities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gedung = Building::where('company_id', auth()->user()->company_id)->get();

        return view('electricities.create', compact('gedung'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreElectricityRequest $request)
    {
        Electricity::create($request->validated());

        return redirect()
            ->route('electricities.index')
            ->with('success', __('Electricity created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Electricity  $electricity
     * @return \Illuminate\Http\Response
     */
    public function show(Electricity $electricity)
    {
        $electricity->load('building:id,name');

        return view('electricities.show', compact('electricity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Electricity  $electricity
     * @return \Illuminate\Http\Response
     */
    public function edit(Electricity $electricity)
    {
        $electricity->load('building:id,name');

        return view('electricities.edit', compact('electricity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Electricity  $electricity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateElectricityRequest $request, Electricity $electricity)
    {
        $electricity->update($request->validated());

        return redirect()
            ->route('electricities.index')
            ->with('success', __('Electricity updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Electricity  $electricity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Electricity $electricity)
    {
        try {
            $electricity->delete();

            return redirect()
                ->route('electricities.index')
                ->with('success', __('Electricity deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('electricities.index')
                ->with('error', __('The Electricity can`t be deleted because it is related to another table.'));
        }
    }
}
