<?php

namespace App\Http\Controllers;


use App\Models\ComingProduct;
use App\Http\Requests\{StoreComingProductRequest, UpdateComingProductRequest};
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ComingProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view comingproduct')->only('index', 'show');
        $this->middleware('permission:create comingproduct')->only('create', 'store');
        $this->middleware('permission:edit comingproduct')->only('edit', 'update');
        $this->middleware('permission:delete comingproduct')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $comingProducts = ComingProduct::with('product:id,name', 'user:id,name', 'company:id,code', 'supplier:id,name')
                ->where('company_id', auth()->user()->company_id);

            return DataTables::of($comingProducts)
                ->addColumn('product', function ($row) {
                    return $row->product ? $row->product->name : '-';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('supplier', function ($row) {
                    return $row->supplier ? $row->supplier->name : '-';
                })->addColumn('action', 'coming-products.include.action')
                ->toJson();
        }


        return view('coming-products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Product::where('company_id', auth()->user()->company_id)->get();

        return view('coming-products.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComingProductRequest $request)
    {
        $request->validated();

        $productId = $request->product_id;
        $stok = Product::select('quantity')->where('id', $productId)->get()->first()->quantity;
        $totalStock = $stok + (int) $request->qty;

        DB::transaction(
            function () use ($request, $productId, $totalStock) {
                ComingProduct::create([
                    'code' => 'INV' . '-' . date('Ymd') . '-' . rand(1, 1000),
                    'date' => Carbon::now(),
                    'product_id' => $productId,
                    'price' => $request->price,
                    'qty' => $request->qty,
                    'supplier_id' => $request->supplier_id,
                    'user_id' => auth()->user()->id,
                    'company_id' => auth()->user()->company_id
                ]);

                Product::where('id', $productId)
                    ->update([
                        'quantity' => $totalStock
                    ]);
            }
        );

        return redirect()
            ->route('coming-products.index')
            ->with('success', __('ComingProduct created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComingProduct  $comingProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ComingProduct $comingProduct)
    {
        $comingProduct->load('product:id,name', 'user:id,name', 'company:id,code', 'supplier:id,name');

        return view('coming-products.show', compact('comingProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComingProduct  $comingProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ComingProduct $comingProduct)
    {
        $comingProduct->load(
            'product:id,name',
            'user:id,name',

            'company:id,code',

            'supplier:id,name'
        );

        return view('coming-products.edit', compact('comingProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComingProduct  $comingProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComingProductRequest $request, ComingProduct $comingProduct)
    {
        $comingProduct->update($request->validated());

        return redirect()
            ->route('coming-products.index')
            ->with('success', __('ComingProduct updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComingProduct  $comingProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComingProduct $comingProduct)
    {
        try {
            $comingProduct->delete();

            return redirect()
                ->route('coming-products.index')
                ->with('success', __('ComingProduct deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('coming-products.index')
                ->with('error', __('The ComingProduct can`t be deleted because it is related to another table.'));
        }
    }
}
