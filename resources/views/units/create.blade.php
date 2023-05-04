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
                    <form class="form-valide" action="{{ route('units.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Tên đơn vị: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="unit_name" name="unit_name"
                                    value="{{ old('unit_name') }}" placeholder="Nhập tên đơn vị">
                                @error('unit_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">Mô tả:</label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-sm" name="description" id="description" placeholder="Nhập tên đơn vị"
                                    style="height: 100px">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a class="btn btn-danger" href="{{ route('units.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
