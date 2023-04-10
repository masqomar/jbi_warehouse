<?php

namespace App\Http\Controllers;

use App\Models\AssetItem;
use Illuminate\Http\Request;

class LaporanAssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view transaction')->only('index');
    }

    public function index()
    {
        $assetItems = AssetItem::with('asset', 'placement_item', 'category')->get();

        // return json_encode($assetItems);
        return view('asset-reports.index', compact('assetItems'));
    }
}
