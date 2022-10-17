<?php

namespace App\Http\Controllers;


use App\Models\AssetItem;
use App\Http\Requests\{StoreAssetItemRequest, UpdateAssetItemRequest};
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AssetItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view assetitem')->only('index', 'show');
        $this->middleware('permission:create assetitem')->only('create', 'store');
        $this->middleware('permission:edit assetitem')->only('edit', 'update');
        $this->middleware('permission:delete assetitem')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $assetItems = AssetItem::with('asset:id,name', 'category:id,code', 'company:id,code', 'user:id,name')
                ->where('company_id', auth()->user()->company_id);

            return DataTables::of($assetItems)
                ->addColumn('asset', function ($row) {
                    return $row->asset ? $row->asset->name : '-';
                })->addColumn('category', function ($row) {
                    return $row->category ? $row->category->code : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('action', 'asset-items.include.action')
                ->toJson();
        }


        return view('asset-items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asset-items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetItemRequest $request)
    {
        AssetItem::create($request->validated());

        return redirect()
            ->route('asset-items.index')
            ->with('success', __('AssetItem created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function show(AssetItem $assetItem)
    {
        $assetItem->load(
            'asset:id,name',
            'category:id,code',

            'company:id,code',

            'user:id,name'
        );

        return view('asset-items.show', compact('assetitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetItem $assetItem)
    {
        $assetItem->load(
            'asset:id,name',
            'category:id,code',

            'company:id,code',

            'user:id,name'
        );

        return view('asset-items.edit', compact('assetitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetItemRequest $request, AssetItem $assetItem)
    {
        $assetItem->update($request->validated());

        return redirect()
            ->route('asset-items.index')
            ->with('success', __('AssetItem updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetItem $assetItem)
    {
        try {
            $assetItem->delete();

            return redirect()
                ->route('asset-items.index')
                ->with('success', __('AssetItem deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('asset-items.index')
                ->with('error', __('The AssetItem can`t be deleted because it is related to another table.'));
        }
    }

    public function search(Request $request)
    {
        $products = AssetItem::with('asset')->where('company_id', Auth::user()->company_id)
            ->where('full_code', 'like', '%' . $request->search . '%')->get();

        return json_encode($products);
    }
}
