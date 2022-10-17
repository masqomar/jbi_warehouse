<?php

namespace App\Http\Controllers;


use App\Models\MutationTo;
use App\Http\Requests\{StoreMutationToRequest, UpdateMutationToRequest};
use Yajra\DataTables\Facades\DataTables;

class MutationToController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view mutationto')->only('index', 'show');
        $this->middleware('permission:create mutationto')->only('create', 'store');
        $this->middleware('permission:edit mutationto')->only('edit', 'update');
        $this->middleware('permission:delete mutationto')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $mutationTos = MutationTo::with('mutation:id,mutation_code', 'placement:id,placement_code');

            return DataTables::of($mutationTos)
                ->addColumn('description', function($row){
                    return str($row->description)->limit(200);
                })
				->addColumn('mutation', function ($row) {
                    return $row->mutation ? $row->mutation->mutation_code : '-';
                })->addColumn('placement', function ($row) {
                    return $row->placement ? $row->placement->placement_code : '-';
                })->addColumn('action', 'mutation-tos.include.action')
                ->toJson();
        }


        return view('mutation-tos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mutation-tos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMutationToRequest $request)
    {
        MutationTo::create($request->validated());

        return redirect()
            ->route('mutation-tos.index')
            ->with('success', __('MutationTo created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MutationTo  $mutationTo
     * @return \Illuminate\Http\Response
     */
    public function show(MutationTo $mutationTo)
    {
        $mutationTo->load('mutation:id,mutation_code', 'placement:id,placement_code');

		return view('mutation-tos.show', compact('mutationto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MutationTo  $mutationTo
     * @return \Illuminate\Http\Response
     */
    public function edit(MutationTo $mutationTo)
    {
        $mutationTo->load('mutation:id,mutation_code', 'placement:id,placement_code');

		return view('mutation-tos.edit', compact('mutationto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MutationTo  $mutationTo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMutationToRequest $request, MutationTo $mutationTo)
    {
        $mutationTo->update($request->validated());

        return redirect()
            ->route('mutation-tos.index')
            ->with('success', __('MutationTo updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MutationTo  $mutationTo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MutationTo $mutationTo)
    {
        try {
            $mutationTo->delete();

            return redirect()
                ->route('mutation-tos.index')
                ->with('success', __('MutationTo deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('mutation-tos.index')
                ->with('error', __('The MutationTo can`t be deleted because it is related to another table.'));
        }
    }
}
