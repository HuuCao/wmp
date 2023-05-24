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
                        <h4>Dữ liệu kho hàng</h4>
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
                            <th>Số lượng</th>
                            <th>Ngày hết hạn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pageItem = 10;
                            $currentPage = $stock_product_data->currentPage();
                            $page = ($currentPage - 1) * $pageItem + 1;
                        @endphp

                        @foreach ($stock_product_data as $stock_inward)
                            <tr class="text-center">
                                <td>{{ $page++ }}</td>
                                <td>
                                    @foreach ($products as $product)
                                        {{ $product->id == $stock_inward->product_id ? $product->name_product : '' }}
                                    @endforeach
                                </td>
                                <td>{{ $stock_inward->quantity }}</td>
                                <td>{{ $stock_inward->expiration_date }}</td>
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
                            <th>Số lượng</th>
                            <th>Ngày hết hạn</th>
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
