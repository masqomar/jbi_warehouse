<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use App\Http\Requests\{StoreAssetRequest, UpdateAssetRequest};
use App\Models\AssetItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view asset')->only('index', 'show');
        $this->middleware('permission:create asset')->only('create', 'store');
        $this->middleware('permission:edit asset')->only('edit', 'update');
        $this->middleware('permission:delete asset')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $assets = Asset::with('unit:id,name', 'category:id,code', 'company:id,code')
                ->where('company_id', Auth::user()->company_id);

            return DataTables::of($assets)
                ->addColumn('specification', function ($row) {
                    return str($row->specification)->limit(200);
                })
                ->addColumn('description', function ($row) {
                    return str($row->description)->limit(200);
                })
                ->addColumn('asset_image', function ($row) {
                    return $row ? $row->getFirstMediaUrl('asset_image', 'thumb') : '-';
                })->addColumn('unit', function ($row) {
                    return $row->unit ? $row->unit->name : '-';
                })->addColumn('category', function ($row) {
                    return $row->category ? $row->category->code : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('action', 'assets.include.action')
                ->toJson();
        }


        return view('assets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetRequest $request)
    {
        DB::transaction(function () use ($request) {
            $asset = Asset::create($request->validated() + ['company_id' => Auth::user()->company_id]);

            if ($request->hasFile('asset_image') && $request->file('asset_image')->isValid()) {
                $asset->addMediaFromRequest('asset_image')->toMediaCollection('asset_image');
            }

            // dd($getAssetID);
            for ($i = 1; $i <= $request->stock; $i++) {
                AssetItem::create([
                    'asset_id' => $asset->id,
                    'purchasing_no' => $request->purchasing_no,
                    'purchasing_date' => $request->purchasing_date,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                    'company_id' => Auth::user()->company_id,
                    'status' => 'Tersedia',
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }
        });

        return redirect()
            ->route('assets.index')
            ->with('success', __('Asset created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        $asset->load('unit:id,name', 'category:id,code', 'company:id,code');
        $assetItems = AssetItem::where('asset_id', $asset->id)->get();

        return view('assets.show', compact('asset', 'assetItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        $asset->load(
            'unit:id,name',
            'category:id,code',

            'company:id,code'
        );

        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->validated());

        return redirect()
            ->route('assets.index')
            ->with('success', __('Asset updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        try {
            $asset->delete();

            return redirect()
                ->route('assets.index')
                ->with('success', __('Asset deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('assets.index')
                ->with('error', __('The Asset can`t be deleted because it is related to another table.'));
        }
    }
}
