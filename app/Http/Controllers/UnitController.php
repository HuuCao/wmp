<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Đơn vị';
        $units = Unit::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('units.index', compact('title', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo đơn vị';
        return view('units.create', compact('title'));
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
            'unit_name' => [
                'required',
                Rule::unique('units', 'unit_name')->where(function ($query) {
                    $query->where('is_active', '!=', 2);
                })
            ]
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'unique' => 'Đơn vị đã tồn tại. Vui lòng nhập đơn vị khác!'
        ];

        $request->validate($rules, $message);

        $units = new Unit();

        $units->unit_name = $request->unit_name;
        $units->description = $request->description;
        $units->save();

        return redirect()->route('units.index')
            ->with('success', 'Unit created successfully.');
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
        $title = 'Chỉnh sửa đơn vị';
        $unit = Unit::find($id);
        return view('units.edit', compact('unit', 'title'));
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
        // request()->validate([
        //     'unit_name' => [
        //         'required',
        //         Rule::unique('units', 'is_active')->where(function ($query) {
        //             return $query->where('is_active', '!=', 2);
        //         })->ignore($id),
        //     ],
        // ]);
        $rules = [
            'unit_name' => [
                'required',
                Rule::unique('units', 'unit_name')->where(function ($query) {
                    $query->where('is_active', '!=', 2);
                })
            ]
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'unique' => 'Đơn vị đã tồn tại. Vui lòng nhập đơn vị khác!'
        ];

        $request->validate($rules, $message);

        $unit_name = $request->unit_name;
        $description = $request->description;

        Unit::where('id', $id)->update([
            'unit_name' => $unit_name,
            'description' => $description
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::where('id', $id)->update([
            'is_active' => 2
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit deleted successfully');
    }
}
