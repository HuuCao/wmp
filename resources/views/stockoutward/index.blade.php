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
                        <a class="btn btn-success" href="{{ route('stockinward.create') }}">Thêm mới</a>
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
                        <p><b>{{ $stock_inward_data->total() }}</b> phiếu</p>
                    </div>
                </div>
            </div>

            @if (count($stock_inward_data) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Mã phiếu nhập</th>
                            <th>Nội dung nhập hàng</th>
                            <th>Ngày nhập</th>
                            <th>Ghi chú</th>
                            <th>Người nhập</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pageItem = 10;
                            $currentPage = $stock_inward_data->currentPage();
                            $page = ($currentPage - 1) * $pageItem + 1;
                        @endphp

                        @foreach ($stock_inward_data as $stock_inward)
                            <tr class="text-center">
                                <td>{{ $page++ }}</td>
                                <td>{{ $stock_inward->stock_inward_code }}</td>
                                <td>{{ $stock_inward->content }}</td>
                                <td>{{ $stock_inward->input_day }}</td>
                                <td>{{ $stock_inward->note }}</td>
                                <td>
                                    @foreach ($users as $user)
                                        {{ $user->id == $stock_inward->user_id ? $user->name : '' }}
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('stockinward.show', $stock_inward->id) }}"><i class="ti-eye"></i></a>
                                    <a href="{{ route('stockinward.edit', $stock_inward->id) }}" class="ml-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a href="" class="ml-2"
                                        onclick="if (confirm('Bạn có chắc muốn xóa danh mục này không?')) { event.preventDefault(); document.getElementById('delete-form-{{ $stock_inward->id }}').submit(); }">
                                        <i class="ti-trash"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['stockinward.destroy', $stock_inward->id],
                                        'id' => 'delete-form-' . $stock_inward->id,
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
                            <th>Mã phiếu nhập</th>
                            <th>Nội dung nhập hàng</th>
                            <th>Ngày nhập</th>
                            <th>Ghi chú</th>
                            <th>Người nhập</th>
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
    {{ $stock_inward_data->links('pagination.custom-pagination') }}
@endsection
