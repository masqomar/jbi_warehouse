<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAllProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view all-product')->only('index', 'show');
        $this->middleware('permission:create all-product')->only('create', 'store');
        $this->middleware('permission:edit all-product')->only('edit', 'update');
        $this->middleware('permission:delete all-product')->only('destroy');
    }

    public function index()
    {
        $products = Product::with('unit', 'category', 'company', 'user')->get();

        return view('all-products.index', compact('products'));
    }

    public function create()
    {
        return view('all-products.create');
    }

    public function store(StoreAllProductRequest $request)
    {
        $product = Product::create($request->validated() + ['company_id' => auth()->user()->company_id, 'user_id' => auth()->user()->id]);

        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
            $product->addMediaFromRequest('product_image')->toMediaCollection('product_image');
        }

        return redirect()->route('all-products.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Product $product)
    {
        return view('all-products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('all-products.edit', compact('product', 'categories'));
    }

    public function update(StoreAllProductRequest $request, Product $product)
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
        $products = Product::where('company_id', auth()->user()->company_id)
            ->where('name', 'like', '%' . $request->search . '%')->get();

        return json_encode($products);
    }
}
