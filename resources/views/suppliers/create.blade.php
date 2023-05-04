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
                    <form class="form-valide" action="{{ route('suppliers.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Mã số thuế:
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="tax_code" name="tax_code"
                                    value="{{ old('tax_code') }}" placeholder="Nhập mã số thuế">
                                @error('tax_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Tên nhà cung cấp: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="supplier_name" name="supplier_name"
                                    value="{{ old('supplier_name') }}" placeholder="Nhập tên nhà cung cấp">
                                @error('supplier_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Số điện thoại: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="phone" name="phone"
                                    value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Email: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Nhập email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Địa chỉ: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="address" name="address"
                                    value="{{ old('address') }}" placeholder="Nhập địa chỉ">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a class="btn btn-danger" href="{{ route('suppliers.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
