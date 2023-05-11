<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Sản phẩm';
        $page_title = 'Products';
        $products = Product::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(2);
        return view('products.index', compact(
            'products',
            'title',
            'page_title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo sản phẩm';
        $page_title = 'Products';
        $units = Unit::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $shelves = Shelves::where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('products.create', compact(
            'title',
            'page_title',
            'units',
            'categories',
            'suppliers',
            'shelves'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name_product' => 'required',
            'sku' => 'required',
            'barcode' => 'required',
            'quantity' => 'required',
            'import_price' => 'required',
            'expiration_date' => 'required',
            'status' => 'required',
            'unit' => 'required',
            'category' => 'required',
            'supplier' => 'required',
            'shelves' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!'
        ];
        $request->validate($rules, $message);

        // Handle code-product
        $count_product = Product::count();
        $code_product = "SP" . str_pad($count_product + 1, 5, "0", STR_PAD_LEFT);

        $products = new Product();

        $products->name_product = $request->name_product;
        $products->code_product = $code_product;
        $products->sku = $request->sku;
        $products->barcode = $request->barcode;
        $products->quantity = $request->quantity;
        $products->import_price = $request->import_price;
        $products->export_price = $request->import_price;
        $products->type = 1;
        $products->manufacture_date = $request->expiration_date;
        $products->expiration_date = $request->expiration_date;
        $products->status = $request->status;
        $products->description = $request->description;
        $products->status = $request->status;
        $products->unit_id = $request->unit;
        $products->category_id = $request->category;
        $products->shelves_id = $request->shelves;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . rand(10000, 99999) . '_' . $image->getClientOriginalName();
            $pathImage = $image->storeAs('images', $fileName, 'public');
            $products->image = $pathImage;
        } else {
            $products->image = 'url';
        }
        $products->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
