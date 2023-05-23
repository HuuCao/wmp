<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\StockInward;
use App\Models\StockProduct;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class StockInwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Nhập hàng';
        $page_title = 'Stock-Inward';
        $stock_inward_data = StockInward::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $users = User::with('roles')->get();
        return view('stockinward.index', compact(
            'stock_inward_data',
            'title',
            'page_title',
            'users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo phiếu nhập';
        $page_title = 'Stock-Inward';
        $units = Unit::where('is_active', 1)->get();
        $products = Product::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $shelves = Shelves::where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('stockinward.create', compact(
            'title',
            'page_title',
            'units',
            'products',
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
            'input_day' => 'required|date|after_or_equal:today'
        ];

        $message = [
            'input_day.required' => 'Ngày nhập kho là bắt buộc.',
            'input_day.after_or_equal' => 'Ngày nhập kho phải lớn hơn hoặc bằng ngày hiện tại.',
            'input_day.date' => 'Ngày nhập kho không đúng định dạng',
        ];
        $request->validate($rules, $message);

        $count_stock = StockInward::count();
        $stock_inward_code = "NK-" . str_pad($count_stock + 1, 5, "0", STR_PAD_LEFT);

        $stock_inward = new StockInward();

        $stock_inward->stock_inward_code = $stock_inward_code;
        $stock_inward->input_day = $request->input_day;
        $stock_inward->user_id = $request->user;
        $stock_inward->content = $request->content;
        $stock_inward->note = $request->note;
        $stock_inward->save();

        $stock_inward_id = $stock_inward->getKey();

        $product_stock_data = $request->input('products');

        foreach ($product_stock_data as $product_stock) {
            $stock_product = new StockProduct();
            $stock_product->stock_id = $stock_inward_id;
            $stock_product->type = 1; // 1: nhập kho, 2: xuất kho
            $stock_product->product_id = $product_stock['product_id'];
            $stock_product->unit_id = $product_stock['unit_id'];
            $stock_product->supplier_id = $product_stock['supplier_id'];
            $stock_product->import_price = $product_stock['import_price'];
            $stock_product->quantity = $product_stock['quantity'];
            $stock_product->expiration_date = $product_stock['expiration_date'];
            $stock_product->total = $product_stock['total'];
            $stock_product->save();
        }

        $message = "WMP THÔNG BÁO NHẬP KHO: Có một phiếu nhập kho mới vừa được tạo với mã phiếu là " . $stock_inward_code . "\n";
        $message .= "Kiểm tra thông tin phiếu nhập ngay. " . route('stockinward.index');
        $chatID = '-925594429';

        $apiToken = "6016271040:AAHLJ8Dk_SngY0HI3b4pAfb2HNuM2u1YmXU";
        $data = [
            'chat_id' => $chatID,
            'text' => $message
        ];
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));

        return redirect()->route('stockinward.index')
            ->with('success', 'Đã tạo thành công phiếu nhập kho.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
