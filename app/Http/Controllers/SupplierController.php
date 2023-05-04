<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Nhà cung cấp';
        $page_title = 'Suppliers';
        $suppliers = Supplier::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(2);

        return view('suppliers.index', compact('title', 'suppliers', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo nhà cung cấp';
        $page_title = 'Suppliers';
        return view('suppliers.create', compact('title', 'page_title'));
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
            'supplier_name' => [
                'required',
                Rule::unique('suppliers', 'supplier_name')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('supplier_name', $request->supplier_name);
                })
            ],
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'tax_code' => 'regex:/^\d{10}$/',
            'email' => 'required|email',
            'address' => 'required'
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'supplier_name.unique' => 'Tên nhà cung cấp đã tồn tại!',
            'phone.regex' => 'Số điện thoại không hợp lệ!',
            'email.email' => 'Email không hợp lệ!',
            'tax_code.regex' => 'Mã số thuế không hợp lệ!'
        ];

        $request->validate($rules, $message);

        // Handle supplier_code
        $count_supplier = Supplier::count();
        $supplier_code = "NCC" . str_pad($count_supplier + 1, 5, "0", STR_PAD_LEFT);

        $suppliers = new Supplier();
        $suppliers->supplier_name = $request->supplier_name;
        $suppliers->supplier_code = $supplier_code;
        $suppliers->tax_code = $request->tax_code;
        $suppliers->phone = $request->phone;
        $suppliers->email = $request->email;
        $suppliers->address = $request->address;
        $suppliers->save();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully.');
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
        $title = 'Chỉnh sửa nhà cung cấp';
        $page_title = 'Suppliers';
        $supplier = Supplier::find($id);
        return view('suppliers.edit', compact('supplier', 'title', 'page_title'));
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
        $rules = [
            'supplier_name' => [
                'required',
                Rule::unique('suppliers', 'supplier_name')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('supplier_name', '<>', $request->supplier_name);
                })
            ],
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'tax_code' => 'regex:/^\d{10}$/',
            'email' => 'required|email',
            'address' => 'required'
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'supplier_name.unique' => 'Tên nhà cung cấp đã tồn tại!',
            'phone.regex' => 'Số điện thoại không hợp lệ!',
            'email.email' => 'Email không hợp lệ!',
            'tax_code.regex' => 'Mã số thuế không hợp lệ!'
        ];

        $request->validate($rules, $message);

        Supplier::where('id', $id)->update([
            'supplier_name' => $request->supplier_name,
            'tax_code' => $request->tax_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::where('id', $id)->update([
            'is_active' => 2
        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully');
    }
}
