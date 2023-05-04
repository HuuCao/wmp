@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('page_name')
    {{ $title }}
@endsection

@section('page_title')
    {{ $page_title }}
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h4>Danh sách loại hàng</h4>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('categories.create') }}">Thêm mới</a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button id="message_success" type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <p><b>{{ $categories->total() }}</b> loại hàng</p>
                    </div>
                </div>
            </div>

            @if (count($categories) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pageItem = 2;
                            $currentPage = $categories->currentPage();
                            $page = ($currentPage - 1) * $pageItem + 1;
                        @endphp

                        @foreach ($categories as $category)
                            <tr class="text-center">
                                <td>{{ $page++ }}</td>
                                <td>{{ $category->name_category }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.show', $category->id) }}"><i class="ti-eye"></i></a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="ml-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a href="" class="ml-2"
                                        onclick="if (confirm('Bạn có chắc muốn xóa danh mục này không?')) { event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit(); }">
                                        <i class="ti-trash"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['categories.destroy', $category->id],
                                        'id' => 'delete-form-' . $category->id,
                                    ]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                </table>
                <div class="col-12 nodata">
                    <span class="iconify"><i class="ti-folder"></i></span>
                    <div>
                        Không có dữ liệu!
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{ $categories->links('pagination.custom-pagination') }}
@endsection
