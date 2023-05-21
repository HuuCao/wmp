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
                        <h4>Danh sách sản phẩm</h4>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal">
                            Import Excel
                        </button>
                        <a class="btn btn-success" href="{{ route('products.create') }}">Thêm mới</a>
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
                        <p><b>{{ $products->total() }}</b> sản phẩm</p>
                    </div>
                </div>
            </div>

            @if (count($products) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Đơn vị tính</th>
                            <th>Người tạo</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pageItem = 10;
                            $currentPage = $products->currentPage();
                            $page = ($currentPage - 1) * $pageItem + 1;
                        @endphp

                        @foreach ($products as $product)
                            <tr class="text-center">
                                <td>{{ $page++ }}</td>
                                <td>{{ $product->code_product }}</td>
                                <td>{{ $product->name_product }}</td>
                                <td>
                                    @foreach ($categories as $category)
                                        {{ $category->id === $product->category_id ? $category->name_category : '' }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($units as $unit)
                                        {{ $unit->id === $product->unit_id ? $unit->unit_name : '' }}
                                    @endforeach
                                </td>
                                <td>Admin</td>
                                @if ($product->status === 'active')
                                    <td><span class="badge badge-success">Đang bán</span></td>
                                @else
                                    <td><span class="badge badge-danger">Tạm dừng</span></td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ route('products.show', $product->id) }}"><i class="ti-eye"></i></a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="ml-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a href="" class="ml-2"
                                        onclick="if (confirm('Bạn có chắc muốn xóa danh mục này không?')) { event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit(); }">
                                        <i class="ti-trash"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['products.destroy', $product->id],
                                        'id' => 'delete-form-' . $product->id,
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
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Đơn vị tính</th>
                            <th>Người tạo</th>
                            <th>Trạng thái</th>
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
    {{ $products->links('pagination.custom-pagination') }}

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('products.import') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="file" name="file" id="file" accept=".xls,.xlsx" required>
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
