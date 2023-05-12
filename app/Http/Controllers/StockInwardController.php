<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shelves;
use App\Models\StockInward;
use App\Models\Supplier;
use App\Models\Unit;
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
        $products = StockInward::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('stockinward.index', compact(
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
        $title = 'Tạo phiếu nhập';
        $page_title = 'Stock-Inward';
        $units = Unit::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $shelves = Shelves::where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active', 1)->get();

        return view('stockinward.create', compact(
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
