<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
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
            $products = Product::with('unit', 'coming_product', 'transaction_detail');

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('unit', function ($row) {
                    return $row->unit ? $row->unit->name : '-';
                })
                ->addColumn('masuk', function ($row) {
                    return $row->coming_product ? $row->coming_product->sum('qty') : '-';
                })
                ->addColumn('keluar', function ($row) {
                    return $row->transaction_detail ? $row->transaction_detail->sum('qty') : '-';
                })
                ->addColumn('saldo_akhir', function ($row) {
                    return $row->first_stock + $row->coming_product->sum('qty') - $row->transaction_detail->sum('qty');
                })
                ->addColumn('total', function ($row) {
                    return $row->price * ($row->first_stock + $row->coming_product->sum('qty') - $row->transaction_detail->sum('qty'));
                })
                ->addColumn('barcet', function ($row) {
                    return $row->price * $row->transaction_detail->sum('qty');
                })
                ->toJson();
        }

        return view('reports.index');
    }

    public function cetakLaporan()
    {
        $laporan = Product::select('*')
            ->get();

        $pdf = Pdf::loadView('reports.cetaklaporan', ['laporan' => $laporan]);
        return $pdf->stream('Laporan-Persediaan.pdf');
    }
}
