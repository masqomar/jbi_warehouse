<?php

namespace App\Http\Controllers;


use App\Models\PlacementItem;
use App\Http\Requests\{StorePlacementItemRequest, UpdatePlacementItemRequest};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PlacementItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view placementitem')->only('index', 'show');
        $this->middleware('permission:create placementitem')->only('create', 'store');
        $this->middleware('permission:edit placementitem')->only('edit', 'update');
        $this->middleware('permission:delete placementitem')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $placementItems = PlacementItem::with('placement:id,placement_code', 'company', 'asset_item:id,full_code');

            return DataTables::of($placementItems)
                ->addColumn('placement', function ($row) {
                    return $row->placement ? $row->placement->placement_code : '-';
                })->addColumn('asset_item', function ($row) {
                    return $row->asset_item ? $row->asset_item->full_code : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->name : '-';
                })->addColumn('action', 'placement-items.include.action')
                ->toJson();
        }


        return view('placement-items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('placement-items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlacementItemRequest $request)
    {
        PlacementItem::create($request->validated());

        return redirect()
            ->route('placement-items.index')
            ->with('success', __('PlacementItem created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlacementItem  $placementItem
     * @return \Illuminate\Http\Response
     */
    public function show(PlacementItem $placementItem)
    {
        $placementItem->load('placement:id,placement_code', 'asset_item:id,code');

        return view('placement-items.show', compact('placementitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlacementItem  $placementItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacementItem $placementItem)
    {
        $placementItem->load('placement:id,placement_code', 'asset_item:id,code');

        return view('placement-items.edit', compact('placementitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlacementItem  $placementItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlacementItemRequest $request, PlacementItem $placementItem)
    {
        $placementItem->update($request->validated());

        return redirect()
            ->route('placement-items.index')
            ->with('success', __('PlacementItem updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlacementItem  $placementItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacementItem $placementItem)
    {
        try {
            $placementItem->delete();

            return redirect()
                ->route('placement-items.index')
                ->with('success', __('PlacementItem deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('placement-items.index')
                ->with('error', __('The PlacementItem can`t be deleted because it is related to another table.'));
        }
    }

    public function search(Request $request)
    {
        $products = PlacementItem::where('company_id', Auth::user()->company_id)
            ->where('name', 'like', '%' . $request->search . '%')->get();

        return json_encode($products);
    }
}
