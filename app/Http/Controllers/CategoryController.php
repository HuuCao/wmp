<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Loại hàng';
        $categories = Category::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Tạo loại hàng';
        return view('categories.create', compact('title'));
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
            'name_category' => 'required'
        ];
        $message = [
            'required' => 'Vui lòng nhập thông tin!',
        ];
        $request->validate($rules, $message);

        $categories = new Category();

        $categories->name_category = $request->name_category;
        $categories->description = $request->description;
        $categories->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories)
    {
        $title = 'Chi tiết loại hàng';
        return view('categories.show', compact('categories', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Chỉnh sửa loại hàng';
        $category = Category::find($id);
        return view('categories.edit', compact('category', 'title'));
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
        request()->validate([
            'name_category' => 'required',
        ]);

        $name_category = $request->name_category;
        $description = $request->description;

        Category::where('id', $id)->update([
            'name_category' => $name_category,
            'description' => $description
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->update([
            'is_active' => 2
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
