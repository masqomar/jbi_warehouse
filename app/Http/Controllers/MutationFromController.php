<?php

namespace App\Http\Controllers;


use App\Models\MutationFrom;
use App\Http\Requests\{StoreMutationFromRequest, UpdateMutationFromRequest};
use Yajra\DataTables\Facades\DataTables;

class MutationFromController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view mutationfrom')->only('index', 'show');
        $this->middleware('permission:create mutationfrom')->only('create', 'store');
        $this->middleware('permission:edit mutationfrom')->only('edit', 'update');
        $this->middleware('permission:delete mutationfrom')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $mutationFroms = MutationFrom::with('mutation:id,mutation_code', 'placement:id,placement_code', 'asset_item:id,code');

            return DataTables::of($mutationFroms)
                ->addColumn('mutation', function ($row) {
                    return $row->mutation ? $row->mutation->mutation_code : '-';
                })->addColumn('placement', function ($row) {
                    return $row->placement ? $row->placement->placement_code : '-';
                })->addColumn('asset_item', function ($row) {
                    return $row->asset_item ? $row->asset_item->code : '-';
                })->addColumn('action', 'mutation-froms.include.action')
                ->toJson();
        }


        return view('mutation-froms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mutation-froms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMutationFromRequest $request)
    {
        MutationFrom::create($request->validated());

        return redirect()
            ->route('mutation-froms.index')
            ->with('success', __('MutationFrom created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MutationFrom  $mutationFrom
     * @return \Illuminate\Http\Response
     */
    public function show(MutationFrom $mutationFrom)
    {
        $mutationFrom->load('mutation:id,mutation_code', 'placement:id,placement_code', 'asset_item:id,code');

		return view('mutation-froms.show', compact('mutationfrom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MutationFrom  $mutationFrom
     * @return \Illuminate\Http\Response
     */
    public function edit(MutationFrom $mutationFrom)
    {
        $mutationFrom->load('mutation:id,mutation_code', 'placement:id,placement_code', 'asset_item:id,code');

		return view('mutation-froms.edit', compact('mutationfrom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MutationFrom  $mutationFrom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMutationFromRequest $request, MutationFrom $mutationFrom)
    {
        $mutationFrom->update($request->validated());

        return redirect()
            ->route('mutation-froms.index')
            ->with('success', __('MutationFrom updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MutationFrom  $mutationFrom
     * @return \Illuminate\Http\Response
     */
    public function destroy(MutationFrom $mutationFrom)
    {
        try {
            $mutationFrom->delete();

            return redirect()
                ->route('mutation-froms.index')
                ->with('success', __('MutationFrom deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('mutation-froms.index')
                ->with('error', __('The MutationFrom can`t be deleted because it is related to another table.'));
        }
    }
}
