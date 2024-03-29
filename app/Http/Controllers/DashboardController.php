<?php

namespace App\Http\Controllers;

use App\Models\AssetItem;
use App\Models\ComingProduct;
use App\Models\Company;
use App\Models\PlacementItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $companyCount = Company::count();
        $userCount = User::count();
        $productCount = Product::count();
        $assetItemCount = AssetItem::count();

        $poTimes = Product::with('company')->where('company_id', auth()->user()->company_id)->get();

        $latestTransactions = Transaction::latest()->where('company_id', auth()->user()->company_id)->paginate(5);
        $latestComingProducts = ComingProduct::latest()->where('company_id', auth()->user()->company_id)->paginate(5);


        //PIC
        $picAssets = PlacementItem::with('asset_item', 'placement')->where('status', 'yes')->where('staff_id', auth()->user()->id)->get();

        // $cek = User::with('company')->get();

        // return json_decode($cek);
        return view('dashboard', compact('companyCount', 'userCount', 'productCount', 'assetItemCount', 'poTimes', 'latestTransactions', 'latestComingProducts', 'picAssets'));
    }
}
