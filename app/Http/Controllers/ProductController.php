<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

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
        $categories = Category::where('is_active', 1)->get();
        $units = Unit::where('is_active', 1)->get();

        return view('products.index', compact(
            'products',
            'title',
            'page_title',
            'categories',
            'units'
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
            'name_product' => [
                'required',
                Rule::unique('products', 'name_product')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('name_product', $request->name_product);
                })
            ],
            'sku' => [
                'required',
                'max:10',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'import_price' => 'nullable|numeric',
            'export_price' => 'nullable|numeric',
            'category' => 'required',
            'image' => 'image|dimensions:width=500,height=500',
        ];

        $message = [
            'name_product.required' => 'Tên của sản phẩm là bắt buộc.',
            'name_product.unique' => 'Tên sản phẩm đã tồn tại.',
            'category.required' => 'Loại sản phẩm là bắt buộc.',
            'sku.required' => 'SKU là bắt buộc.',
            'sku.max' => 'SKU không được vượt quá 10 ký tự.',
            'sku.regex' => 'SKU chỉ có thể chứa các ký tự chữ và số.',
            'import_price.numeric' => 'Giá nhập phải là một con số.',
            'export_price.numeric' => 'Giá nhập phải là một con số.',
            'image.image' => 'Hình ảnh không đúng định dạng.',
            'image.dimensions' => 'Hình ảnh không đúng kích thước.'
        ];
        $request->validate($rules, $message);

        // Handle code-product
        $count_product = Product::count();
        $code_product = "SP" . str_pad($count_product + 1, 5, "0", STR_PAD_LEFT);

        $products = new Product();

        $products->name_product = $request->name_product;
        $products->sku = $request->sku;
        $products->code_product = $code_product;
        $products->quantity = 0;
        $products->import_price = $request->import_price;
        $products->export_price = $request->export_price;
        $products->type = 0; // 1: nhập kho, 2: xuất kho
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
        }
        $products->save();

        $message = "WMP THÔNG BÁO: Có một sản phẩm mới vừa được tạo với mã sản phẩm là " . $code_product . "\n";
        $message .= "Kiểm tra sản phẩm ngay. " . route('products.index');
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
            'name_product' => [
                'required',
                Rule::unique('products', 'name_product')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('name_product', '<>', $request->name_product);
                })
            ],
            'sku' => [
                'required',
                'max:10',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'import_price' => 'nullable|numeric',
            'export_price' => 'nullable|numeric',
            'category' => 'required',
            'image' => 'image|dimensions:width=500,height=500',
        ];

        $message = [
            'name_product.required' => 'Tên của sản phẩm là bắt buộc.',
            'name_product.unique' => 'Tên sản phẩm đã tồn tại.',
            'category.required' => 'Loại sản phẩm là bắt buộc.',
            'sku.required' => 'SKU là bắt buộc.',
            'sku.max' => 'SKU không được vượt quá 10 ký tự.',
            'sku.regex' => 'SKU chỉ có thể chứa các ký tự chữ và số.',
            'import_price.numeric' => 'Giá nhập phải là một con số.',
            'export_price.numeric' => 'Giá nhập phải là một con số.',
            'image.image' => 'Hình ảnh không đúng định dạng.',
            'image.dimensions' => 'Hình ảnh không đúng kích thước.'
        ];
        $request->validate($rules, $message);

        $name_product = $request->name_product;
        $sku = $request->sku;
        $import_price = $request->import_price;
        $export_price = $request->export_price;
        $status = $request->status;
        $description = $request->description;
        $unit_id = $request->unit;
        $category_id = $request->category;
        $shelves_id = $request->shelves;
        $image = $request->input('existing_image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . rand(10000, 99999) . '_' . $image->getClientOriginalName();
            $pathImage = $image->storeAs('images', $fileName, 'public');
            $image = $pathImage;
        }

        Product::where('id', $id)->update([
            'name_product' => $name_product,
            'sku' => $sku,
            'import_price' => $import_price,
            'export_price' => $export_price,
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

    /**
     * Search product.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('sku', 'LIKE', "%{$query}%")->get();

        return response()->json($products);
    }

    /**
     * Import product.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');

        Excel::import(new ProductImport, $file);

        return redirect()->back()->with('success', 'Import sản phẩm thành công.');
    }
}
