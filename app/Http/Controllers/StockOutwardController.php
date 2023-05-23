<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shelves;
use App\Models\StockOutward;
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
        $categories = Category::where('is_active', 1)->get();
        $shelves = Shelves::where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('stockoutward.create', compact(
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
