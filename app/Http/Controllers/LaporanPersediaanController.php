<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LaporanPersediaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view transaction')->only('index', 'cetakLaporan');
    }

    public function index()
    {
        if (request()->ajax()) {
            $products = Product::with('unit', 'category', 'coming_product', 'transaction_detail', 'fifo_stock')
                ->where('company_id', Auth::user()->company_id);

            return DataTables::of($products)
                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : '-';
                })
                ->addColumn('unit', function ($row) {
                    return $row->unit ? $row->unit->name : '-';
                })
                ->addColumn('harga_beli', function ($row) {
                    return $row->fifo_stock->sum('total_price') / $row->fifo_stock->sum('quantity');
                })
                ->addColumn('masuk', function ($row) {
                    return $row->coming_product ? $row->coming_product->sum('qty') : '-';
                })
                ->addColumn('keluar', function ($row) {
                    return $row->transaction_detail ? $row->transaction_detail->sum('qty') : '-';
                })
                ->addColumn('saldo_akhir', function ($row) {
                    return $row->coming_product->sum('qty') - $row->transaction_detail->sum('qty');
                })
                ->addColumn('total', function ($row) {
                    return $row->fifo_stock->sum('total_price');
                })
                ->addColumn('biaya_barcet', function ($row) {
                    return $row->transaction_detail->sum('total_price');
                })

                ->toJson();
        }

        return view('reports.index');
    }
}
