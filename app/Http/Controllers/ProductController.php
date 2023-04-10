<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\ComingProduct;
use App\Models\FifoStock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view product')->only('index', 'show');
        $this->middleware('permission:create product')->only('create', 'store');
        $this->middleware('permission:edit product')->only('edit', 'update');
        $this->middleware('permission:delete product')->only('destroy');
    }

    public function index()
    {
        $products = Product::with('unit', 'category', 'company', 'user')
            ->where('company_id', Auth::user()->company_id)
            ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        DB::transaction(
            function () use ($request) {

                $product = Product::create($request->validated() + ['first_stock' => $request->quantity, 'company_id' => Auth::user()->company_id, 'user_id' => Auth::user()->id]);

                if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
                    $product->addMediaFromRequest('product_image')->toMediaCollection('product_image');
                }

                FifoStock::create([
                    'quantity' => $request->quantity,
                    'price'  => $request->price,
                    'date' => now(),
                    'product_id' => $product->id,
                    'total_price' => $request->quantity * $request->price
                ]);

                ComingProduct::create([
                    'code' => 'BM-' . date('Y') . '-' . rand(1000000, 9999999),
                    'date' => now(),
                    'product_id' => $product->id,
                    'price' => $request->price,
                    'qty' => $request->quantity,
                    'team_id' => Auth::user()->team_id,
                    'supplier_id' => 1,
                    'total_price' => $request->quantity * $request->price,
                    'user_id' => Auth::user()->id,
                    'company_id' => Auth::user()->company_id,
                ]);
            }
        );

        return redirect()->route('products.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Product $product)
    {
        $product->load('unit:id,name', 'category:id,code', 'company:id,name',);
        $fifoStocks = FifoStock::where('product_id', $product->id)->get();

        return view('products.show', compact('product', 'fifoStocks'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->input('image', false)) {
            if (!$product->image || $request->input('image') !== $product->image->file_name) {
                $product->image->delete();
                $product->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } else if ($product->image) {
            $product->image->delete();
        }

        return redirect()->route('products.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function search(Request $request)
    {
        $products = Product::where('company_id', Auth::user()->company_id)
            ->where('name', 'like', '%' . $request->search . '%')->get();

        return json_encode($products);
    }
}
