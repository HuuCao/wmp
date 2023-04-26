@extends('layouts.app')

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

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pageItem = 10;
                        $currentPage = $categories->currentPage();
                        $page = ($currentPage - 1) * $pageItem + 1;
                    @endphp

                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $page++ }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.index') }}"><i class="ti-trash"></i></a>
                                <a href="{{ route('categories.index') }}"><i class="ti-pencil-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $categories->links('pagination.custom-pagination') }}
@endsection
