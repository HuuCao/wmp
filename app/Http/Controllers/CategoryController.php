<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $page_title = 'Categories';
        $categories = Category::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->paginate(2);

        return view('categories.index', compact('title', 'categories', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Tạo loại hàng';
        $page_title = 'Categories';
        return view('categories.create', compact('title', 'page_title'));
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
            'name_category' => [
                'required',
                Rule::unique('categories', 'name_category')->where(function ($query) use ($request) {
                    $query->where('is_active', '!=', 2)->where('name_category', $request->name_category);
                })
            ]
        ];

        $message = [
            'required' => 'Vui lòng nhập thông tin!',
            'unique' => 'Loại hàng đã tồn tại. Vui lòng nhập loại hàng khác!'
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
        $page_title = 'Categories';
        $category = Category::find($id);
        return view('categories.edit', compact('category', 'title', 'page_title'));
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
