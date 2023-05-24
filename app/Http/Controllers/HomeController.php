<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\StockProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Home';
        $page_title = 'Welcome!';
        $customers = Customer::where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active', 1)->get();
        $products = Product::where('is_active', 1)->get();
        $revenue = StockProduct::where('type', 2)->sum('total');
        return view('home', compact(
            'title',
            'page_title',
            'customers',
            'suppliers',
            'products',
            'revenue'
        ));
    }
}
