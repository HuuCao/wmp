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
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="row">
                <div class="card-title mx-auto">
                    <h4>Nhập thông tin</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="input-sizes">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Tên loại hàng: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" value="{{ $category->name_category }}"
                                    id="name_category" name="name_category" placeholder="Nhập tên loại hàng">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Mô tả:
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-sm" name="description" id="description" placeholder="Nhập tên loại hàng"
                                    style="height: 100px">{{ $category->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a class="btn btn-danger" href="{{ route('categories.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
