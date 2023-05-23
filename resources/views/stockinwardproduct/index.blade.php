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
                        <h4>Danh sách sản phẩm nhập</h4>
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
                        <p><b>{{ $stock_product_data->total() }}</b> phiếu</p>
                    </div>
                </div>
            </div>

            @if (count($stock_product_data) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Đơn vị</th>
                            <th>Ngày hết hạn</th>
                            <th>Tông tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pageItem = 10;
                            $currentPage = $stock_product_data->currentPage();
                            $page = ($currentPage - 1) * $pageItem + 1;
                        @endphp

                        @foreach ($stock_product_data as $stock_product)
                            <tr class="text-center">
                                <td>{{ $page++ }}</td>
                                <td>
                                    @foreach ($products as $product)
                                        {{ $product->id == $stock_product->product_id ? $product->name_product : '' }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($suppliers as $supplier)
                                        {{ $supplier->id == $stock_product->supplier_id ? $supplier->supplier_name : '' }}
                                    @endforeach
                                </td>
                                <td>{{ $stock_product->quantity }}</td>
                                <td>{{ $stock_product->import_price }}</td>
                                <td>
                                    @foreach ($units as $unit)
                                        {{ $unit->id == $stock_product->unit_id ? $unit->unit_name : '' }}
                                    @endforeach
                                </td>
                                <td>{{ $stock_product->expiration_date }}</td>
                                <td>{{ $stock_product->total }}</td>
                                <td class="text-center">
                                    <a href="{{ route('stockinward.show', $stock_product->id) }}"><i
                                            class="ti-eye"></i></a>
                                    <a href="{{ route('stockinward.edit', $stock_product->id) }}" class="ml-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a href="" class="ml-2"
                                        onclick="if (confirm('Bạn có chắc muốn xóa danh mục này không?')) { event.preventDefault(); document.getElementById('delete-form-{{ $stock_product->id }}').submit(); }">
                                        <i class="ti-trash"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['stockinward.destroy', $stock_product->id],
                                        'id' => 'delete-form-' . $stock_product->id,
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
                            <th>Tên sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Đơn vị</th>
                            <th>Ngày hết hạn</th>
                            <th>Tông tiền</th>
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
    {{ $stock_product_data->links('pagination.custom-pagination') }}
@endsection
