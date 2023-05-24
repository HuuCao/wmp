<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockInward;
use App\Models\StockOutward;
use App\Models\StockProduct;
use App\Models\User;
use Illuminate\Http\Request;

class StockDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dữ liệu kho hàng';
        $page_title = 'Stock-Data';
        $stock_inward_data = StockInward::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->get();
        $products = Product::where('is_active', 1)
            ->get();
        $stock_outward_data = StockOutward::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->get();
        $stock_product_data = StockProduct::where('is_active', 1)
            ->groupBy('product_id')
            ->having('type', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $users = User::with('roles')->get();
        return view('stockdata.index', compact(
            'stock_inward_data',
            'stock_outward_data',
            'stock_product_data',
            'title',
            'page_title',
            'products',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
