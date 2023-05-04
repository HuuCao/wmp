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
                    <form class="form-valide" action="{{ route('shelves.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Tên loại hàng: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="shelves_name" name="shelves_name" value="{{ old('shelves_name') }}"
                                    placeholder="Nhập tên loại hàng">
                                @error('shelves_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Vị trí: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="location" name="location" value="{{ old('location') }}"
                                    placeholder="Nhập tên vị trí">
                                @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">Mô tả: <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-sm" name="description" id="description"
                                    placeholder="Nhập mô tả" style="height: 100px">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a class="btn btn-danger" href="{{ route('shelves.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
