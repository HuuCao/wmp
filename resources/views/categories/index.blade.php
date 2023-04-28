@extends('layouts.app')

@section('title')
    {{ $title }}
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

            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pageItem = 5;
                        $currentPage = $categories->currentPage();
                        $page = ($currentPage - 1) * $pageItem + 1;
                    @endphp

                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center">{{ $page++ }}</td>
                            <td>{{ $category->name_category }}</td>
                            <td>{{ $category->description }}</td>
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
        </div>
    </div>
    {{ $categories->links('pagination.custom-pagination') }}
@endsection
