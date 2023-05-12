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
                        <h4>Danh sách phiếu nhập</h4>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('stock-inward.create') }}">Thêm mới</a>
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
                        <p><b>{{ $products->total() }}</b> phiếu</p>
                    </div>
                </div>
            </div>

            @if (count($products) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Giá nhập</th>
                            <th>Giá xuất</th>
                            <th>Số lượng</th>
                            <th>Hạn sử dụng</th>
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
                                <td>{{ $product->import_price }}</td>
                                <td>{{ $product->export_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->expiration_date }}</td>
                                <td class="text-center">
                                    <a href="{{ route('stock-inward.show', $product->id) }}"><i class="ti-eye"></i></a>
                                    <a href="{{ route('stock-inward.edit', $product->id) }}" class="ml-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a href="" class="ml-2"
                                        onclick="if (confirm('Bạn có chắc muốn xóa danh mục này không?')) { event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit(); }">
                                        <i class="ti-trash"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['stock-inward.destroy', $product->id],
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
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Giá nhập</th>
                            <th>Giá xuất</th>
                            <th>Số lượng</th>
                            <th>Hạn sử dụng</th>
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
@endsection
