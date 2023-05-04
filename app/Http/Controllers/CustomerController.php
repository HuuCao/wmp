<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Khách hàng';
        $page_title = 'Customers';
        $customers = Customer::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(2);

        return view('customers.index', compact('title', 'customers', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo khách hàng';
        $page_title = 'Customers';
        return view('customers.create', compact('title', 'page_title'));
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
            'customer_name' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'email' => 'required|email',
            'address' => 'required'
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'phone.regex' => 'Số điện thoại không hợp lệ!',
            'email.email' => 'Email không hợp lệ!'
        ];

        $request->validate($rules, $message);

        // Handle supplier_code
        $count_customer = Customer::count();
        $customer_code = "KH" . str_pad($count_customer + 1, 5, "0", STR_PAD_LEFT);

        $customers = new Customer();
        $customers->customer_name = $request->customer_name;
        $customers->customer_code = $customer_code;
        $customers->phone = $request->phone;
        $customers->email = $request->email;
        $customers->address = $request->address;
        $customers->save();

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
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
        $title = 'Chỉnh sửa thông tin khách hàng';
        $page_title = 'Customers';
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer', 'title', 'page_title'));
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
            'customer_name' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'email' => 'required|email',
            'address' => 'required'
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'phone.regex' => 'Số điện thoại không hợp lệ!',
            'email.email' => 'Email không hợp lệ!'
        ];

        $request->validate($rules, $message);

        Customer::where('id', $id)->update([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::where('id', $id)->update([
            'is_active' => 2
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}
