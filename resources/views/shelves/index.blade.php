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
                        <h4>Danh sách kệ</h4>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('shelves.create') }}">Thêm mới</a>
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
                        <p><b>{{ $shelves->total() }}</b> kệ</p>
                    </div>
                </div>
            </div>

            @if (count($shelves) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Tên kệ</th>
                            <th>Vị trí</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pageItem = 5;
                            $currentPage = $shelves->currentPage();
                            $page = ($currentPage - 1) * $pageItem + 1;
                        @endphp

                        @foreach ($shelves as $shelf)
                            <tr class="text-center">
                                <td>{{ $page++ }}</td>
                                <td>{{ $shelf->shelves_name }}</td>
                                <td>{{ $shelf->location }}</td>
                                <td>{{ $shelf->description }}</td>
                                <td>{{ $shelf->created_at }}</td>
                                <td>{{ $shelf->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('shelves.show', $shelf->id) }}"><i class="ti-eye"></i></a>
                                    <a href="{{ route('shelves.edit', $shelf->id) }}" class="ml-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a href="" class="ml-2"
                                        onclick="if (confirm('Bạn có chắc muốn xóa danh mục này không?')) { event.preventDefault(); document.getElementById('delete-form-{{ $shelf->id }}').submit(); }">
                                        <i class="ti-trash"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['shelves.destroy', $shelf->id],
                                        'id' => 'delete-form-' . $shelf->id,
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
                            <th>Tên kệ</th>
                            <th>Vị trí</th>
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
    {{ $shelves->links('pagination.custom-pagination') }}
@endsection
