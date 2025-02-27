<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockInward;
use App\Models\StockProduct;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class StockInwardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Sản phẩm đã nhập';
        $page_title = 'Stock-Inward-Product';
        $stock_product_data = StockProduct::where('is_active', 1)
            ->where('type', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $stock_inward_data = StockInward::where('is_active', 1)
            ->get();
        $products = Product::where('is_active', 1)
            ->get();
        $suppliers = Supplier::where('is_active', 1)
            ->get();
        $units = Unit::where('is_active', 1)
            ->get();
        return view('stockinwardproduct.index', compact(
            'stock_product_data',
            'title',
            'page_title',
            'products',
            'suppliers',
            'units',
            'stock_inward_data'
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
