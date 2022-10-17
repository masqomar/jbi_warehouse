<?php

namespace App\Http\Controllers;


use App\Models\AssetMaintenance;
use App\Http\Requests\{StoreAssetMaintenanceRequest, UpdateAssetMaintenanceRequest};
use App\Models\AssetItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AssetMaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view assetmaintenance')->only('index', 'show');
        $this->middleware('permission:create assetmaintenance')->only('create', 'store');
        $this->middleware('permission:edit assetmaintenance')->only('edit', 'update');
        $this->middleware('permission:delete assetmaintenance')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $assetMaintenances = AssetMaintenance::with('asset_item:id,full_code');

            return DataTables::of($assetMaintenances)
                ->addColumn('code', function ($row) {
                    return $row ? $row->company->code . '-' . $row->asset_item_id . '-' . str_pad($row->code, 4, '0', STR_PAD_LEFT) : '-';
                })
                ->addColumn('finish_note', function ($row) {
                    return str($row->finish_note)->limit(200);
                })
                ->addColumn('description', function ($row) {
                    return str($row->description)->limit(200);
                })
                ->addColumn('asset_item', function ($row) {
                    return $row->asset_item ? $row->asset_item->full_code : '-';
                })->addColumn('action', 'asset-maintenances.include.action')
                ->toJson();
        }


        return view('asset-maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asset-maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetMaintenanceRequest $request)
    {
        DB::transaction(
            function () use ($request) {
                AssetMaintenance::create($request->validated() + (['status' => 'Proses', 'company_id' => Auth::user()->company_id]));

                AssetItem::where('id', $request->asset_item_id)
                    ->update([
                        'status' => 'Diservis'
                    ]);
            }
        );

        return redirect()
            ->route('asset-maintenances.index')
            ->with('success', __('AssetMaintenance created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetMaintenance  $assetMaintenance
     * @return \Illuminate\Http\Response
     */
    public function show(AssetMaintenance $assetMaintenance)
    {
        $assetMaintenance->load('asset_item:id,code,full_code');

        return view('asset-maintenances.show', compact('assetMaintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetMaintenance  $assetMaintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetMaintenance $assetMaintenance)
    {
        $assetMaintenance->load('asset_item:id,code');

        return view('asset-maintenances.edit', compact('assetMaintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetMaintenance  $assetMaintenance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetMaintenanceRequest $request, AssetMaintenance $assetMaintenance)
    {
        $assetMaintenance->update($request->validated());

        return redirect()
            ->route('asset-maintenances.index')
            ->with('success', __('AssetMaintenance updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetMaintenance  $assetMaintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetMaintenance $assetMaintenance)
    {
        try {
            $assetMaintenance->delete();

            return redirect()
                ->route('asset-maintenances.index')
                ->with('success', __('AssetMaintenance deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('asset-maintenances.index')
                ->with('error', __('The AssetMaintenance can`t be deleted because it is related to another table.'));
        }
    }
}
