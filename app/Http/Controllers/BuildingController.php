<?php

namespace App\Http\Controllers;


use App\Models\Building;
use App\Http\Requests\{StoreBuildingRequest, UpdateBuildingRequest};
use Yajra\DataTables\Facades\DataTables;

class BuildingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view building')->only('index', 'show');
        $this->middleware('permission:create building')->only('create', 'store');
        $this->middleware('permission:edit building')->only('edit', 'update');
        $this->middleware('permission:delete building')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $buildings = Building::with('company:id,code')
                ->where('company_id', auth()->user()->company_id);

            return DataTables::of($buildings)
                ->addColumn('address', function ($row) {
                    return str($row->address)->limit(200);
                })
                ->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('action', 'buildings.include.action')
                ->toJson();
        }


        return view('buildings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBuildingRequest $request)
    {
        Building::create($request->validated());

        return redirect()
            ->route('buildings.index')
            ->with('success', __('Building created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        $building->load('company:id,code');

        return view('buildings.show', compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $building->load('company:id,code');

        return view('buildings.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $building->update($request->validated());

        return redirect()
            ->route('buildings.index')
            ->with('success', __('Building updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        try {
            $building->delete();

            return redirect()
                ->route('buildings.index')
                ->with('success', __('Building deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('buildings.index')
                ->with('error', __('The Building can`t be deleted because it is related to another table.'));
        }
    }
}
