@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="card-title">
                    <h4>Thêm loại hàng</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="input-sizes">
                    <form class="form-valide" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Tên loại hàng: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="name_category" name="name_category"
                                    placeholder="Nhập tên loại hàng">
                                @error('name_category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">Mô tả: <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-sm" name="description_category" id="description_category"
                                    placeholder="Nhập tên loại hàng" style="height: 100px"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a class="btn btn-danger" href="{{ route('categories.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
