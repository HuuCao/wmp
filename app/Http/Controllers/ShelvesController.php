<?php

namespace App\Http\Controllers;

use App\Models\Shelves;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShelvesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kệ hàng';
        $page_title = 'Shelves';
        $shelves = Shelves::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(2);

        return view('shelves.index', compact('title', 'shelves', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo kệ hàng';
        $page_title = 'Shelves';
        return view('shelves.create', compact('title', 'page_title'));
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
            'shelves_name' => [
                'required',
                Rule::unique('shelves', 'shelves_name')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('shelves_name', $request->shelves_name);
                })
            ]
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'unique' => 'Loại hàng đã tồn tại. Vui lòng nhập loại hàng khác!'
        ];
        $request->validate($rules, $message);

        $shelves = new Shelves();

        $shelves->shelves_name = $request->shelves_name;
        $shelves->location = $request->location;
        $shelves->description = $request->description;
        $shelves->save();

        return redirect()->route('shelves.index')
            ->with('success', 'Shelves created successfully.');
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
        $title = 'Chỉnh sửa kệ hàng';
        $page_title = 'Shelves';
        $shelves = Shelves::find($id);
        return view('shelves.edit', compact('shelves', 'title', 'page_title'));
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
            'shelves_name' => [
                'required',
                Rule::unique('shelves', 'shelves_name')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('shelves_name', '<>', $request->shelves_name);
                })
            ]
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'unique' => 'Kệ đã tồn tại. Vui lòng nhập tên khác!'
        ];

        $request->validate($rules, $message);

        $shelves_name = $request->shelves_name;
        $location = $request->location;
        $description = $request->description;

        Shelves::where('id', $id)->update([
            'shelves_name' => $shelves_name,
            'location' => $location,
            'description' => $description
        ]);

        return redirect()->route('shelves.index')
            ->with('success', 'Shelves updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shelves::where('id', $id)->update([
            'is_active' => 2
        ]);

        return redirect()->route('shelves.index')
            ->with('success', 'Shelves deleted successfully');
    }
}
