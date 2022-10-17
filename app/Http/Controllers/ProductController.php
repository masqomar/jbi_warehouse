<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $product = Product::create($request->validated() + ['company_id' => Auth::user()->company_id, 'user_id' => Auth::user()->id]);

        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
            $product->addMediaFromRequest('product_image')->toMediaCollection('product_image');
        }

        return redirect()->route('products.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
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
