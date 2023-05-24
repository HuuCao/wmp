<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\StockOutward;
use App\Models\StockProduct;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class StockOutwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Xuất hàng';
        $page_title = 'Stock-Outward';
        $stock_outward_data = StockOutward::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $users = User::with('roles')->get();
        return view('stockoutward.index', compact(
            'stock_outward_data',
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
        $title = 'Tạo phiếu xuất';
        $page_title = 'Stock-Outward';
        $units = Unit::where('is_active', 1)->get();
        $products = Product::where('is_active', 1)->get();
        $stock_product_data = StockProduct::where('is_active', 1)
            ->where('type', 1)
            ->groupBy('product_id')
            ->get();
        $categories = Category::where('is_active', 1)->get();
        $shelves = Shelves::where('is_active', 1)->get();
        $customers = Customer::where('is_active', 1)->get();

        return view('stockoutward.create', compact(
            'title',
            'page_title',
            'units',
            'products',
            'stock_product_data',
            'categories',
            'customers',
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
            'output_day' => 'required|date|after_or_equal:today'
        ];

        $message = [
            'output_day.required' => 'Ngày xuất kho là bắt buộc.',
            'output_day.after_or_equal' => 'Ngày xuất kho phải lớn hơn hoặc bằng ngày hiện tại.',
            'output_day.date' => 'Ngày xuất kho không đúng định dạng',
        ];
        $request->validate($rules, $message);
        // dd($request);
        $count_stock = StockOutward::count();
        $stock_outward_code = "XK-" . str_pad($count_stock + 1, 5, "0", STR_PAD_LEFT);

        $stock_outward = new StockOutward();
        $stock_outward->stock_outward_code = $stock_outward_code;
        $stock_outward->output_day = $request->output_day;
        $stock_outward->user_id = $request->user;
        $stock_outward->content = $request->content;
        $stock_outward->note = $request->note;
        $stock_outward->save();

        $stock_outward_id = $stock_outward->getKey();

        $product_stock_data = $request->input('products');

        $total_price = 0;

        foreach ($product_stock_data as $product_stock) {
            $stock_product = new StockProduct();
            $stock_product->stock_id = $stock_outward_id;
            $stock_product->product_id = $product_stock['product_id'];
            $stock_product->expiration_date = $product_stock['expiration_date'];
            $stock_product_in_stock = StockProduct::where('product_id', $product_stock['product_id'])
                ->where('expiration_date', $product_stock['expiration_date'])
                ->where('type', 1)
                ->first();
            
            if ($product_stock['quantity'] > $stock_product_in_stock->quantity) {
                return redirect()->back()->withErrors(['products' => 'Số lượng sản phẩm xuất kho không hợp lệ.']);
            }
            $stock_product->type = 2; // 1: nhập kho, 2: xuất kho
            $stock_product->customer_id = $product_stock['customer_id'];
            $stock_product->export_price = $product_stock['export_price'];
            $stock_product->quantity = $product_stock['quantity'];
            $stock_product->total = $product_stock['total'];
            $stock_product->save();

            StockProduct::where('product_id', $product_stock['product_id'])
                ->where('expiration_date', $product_stock['expiration_date'])
                ->where('type', 1)
                ->update([
                    'quantity' => ($stock_product_in_stock->quantity) - ($product_stock['quantity'])
                ]);
            
            $total_price += $product_stock['total'];
        }

        $message = "WMP THÔNG BÁO XUẤT KHO: Có một phiếu xuất kho mới vừa được tạo với mã phiếu là " . $stock_outward_code . "\n";
        $message .= "Thông tin nhanh tổng giá trị phiếu xuất là:  " . $total_price ."VNĐ". "\n";
        $message .= "Kiểm tra thông tin phiếu xuất ngay. " . route('stockoutward.index');
        $chatID = '-989580284';

        $apiToken = "6258537139:AAFHxuJ2Sv5OIBXph3dbvUa7xxPfDraROsc";
        $data = [
            'chat_id' => $chatID,
            'text' => $message
        ];
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));

        return redirect()->route('stockoutward.index')
            ->with('success', 'Đã tạo thành công phiếu xuất kho.');
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
