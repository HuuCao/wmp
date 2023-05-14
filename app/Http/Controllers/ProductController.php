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
            ->paginate(10);
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
            'sku' => [
                'required',
                'max:10',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'barcode' => [
                'nullable',
                'regex:/^\d{8}$|^\d{13}$/'
            ],
            'quantity' => 'nullable|numeric',
            'import_price' => 'nullable|numeric',
            'expiration_date' => 'nullable|date',
        ];

        $message = [
            'name_product.required' => 'Tên của sản phẩm là bắt buộc.',
            'sku.required' => 'SKU là bắt buộc.',
            'sku.max' => 'SKU không được vượt quá 10 ký tự.',
            'sku.regex' => 'SKU chỉ có thể chứa các ký tự chữ và số.',
            'barcode.regex' => 'Mã vạch phải có 8 hoặc 13 chữ số.',
            'quantity.numeric' => 'Số lượng phải là một con số.',
            'import_price.numeric' => 'Giá nhập phải là một con số.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
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
        if ($request->quantity) {
            $products->quantity = $request->quantity;
        } else {
            $products->quantity = 0;
        }
        $products->import_price = $request->import_price;
        $products->type = 1;
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

        $message = "Có một sản phẩm mới vừa được tạo với mã sản phẩm là " . $code_product;
        $chatID = '-814715937';

        $apiToken = "5751384612:AAF-yfw4fWeWlJV2M23WOnwjVvXV1JgCojE";
        $data = [
            'chat_id' => $chatID,
            'text' => $message
        ];
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));

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
    public function edit($id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $page_title = 'Products';

        $product = Product::find($id);

        $units = Unit::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $shelves = Shelves::where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('products.edit', compact(
            'title',
            'page_title',
            'product',
            'units',
            'categories',
            'suppliers',
            'shelves'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_product' => 'required',
            'sku' => [
                'required',
                'max:10',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'barcode' => [
                'nullable',
                'regex:/^\d{8}$|^\d{13}$/'
            ],
            'quantity' => 'nullable|numeric',
            'import_price' => 'nullable|numeric',
            'expiration_date' => 'nullable|date',
        ];

        $message = [
            'name_product.required' => 'Tên của sản phẩm là bắt buộc.',
            'sku.required' => 'SKU là bắt buộc.',
            'sku.max' => 'SKU không được vượt quá 10 ký tự.',
            'sku.regex' => 'SKU chỉ có thể chứa các ký tự chữ và số.',
            'barcode.regex' => 'Mã vạch phải có 8 hoặc 13 chữ số.',
            'quantity.numeric' => 'Số lượng phải là một con số.',
            'import_price.numeric' => 'Giá nhập phải là một con số.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
        ];
        $request->validate($rules, $message);

        $name_product = $request->name_product;
        $sku = $request->sku;
        $barcode = $request->barcode;
        $quantity = $request->quantity;
        $import_price = $request->import_price;
        $expiration_date = $request->expiration_date;
        $status = $request->status;
        $description = $request->description;
        $unit_id = $request->unit;
        $category_id = $request->category;
        $shelves_id = $request->shelves;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . rand(10000, 99999) . '_' . $image->getClientOriginalName();
            $pathImage = $image->storeAs('images', $fileName, 'public');
            $image = $pathImage;
        }

        Product::where('id', $id)->update([
            'name_product' => $name_product,
            'sku' => $sku,
            'barcode' => $barcode,
            'quantity' => $quantity,
            'import_price' => $import_price,
            'expiration_date' => $expiration_date,
            'status' => $status,
            'description' => $description,
            'unit_id' => $unit_id,
            'category_id' => $category_id,
            'shelves_id' => $shelves_id,
            'image' => $image,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->update([
            'is_active' => 2
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('sku', 'LIKE', "%{$query}%")->get();

        return response()->json($products);
    }
}
