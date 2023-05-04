@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="card-title">
                    <h4>Chỉnh sửa nhà cung cấp</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="input-sizes">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Mã số thuế:
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="tax_code" name="tax_code"
                                    value="{{ $supplier->tax_code }}" placeholder="Nhập mã số thuế">
                                @error('tax_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Tên nhà cung cấp: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="supplier_name" name="supplier_name"
                                    value="{{ $supplier->supplier_name }}" placeholder="Nhập tên nhà cung cấp">
                                @error('supplier_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Số điện thoại: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="phone" name="phone"
                                    value="{{ $supplier->phone }}" placeholder="Nhập số điện thoại">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Email: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="email" name="email"
                                    value="{{ $supplier->email }}" placeholder="Nhập email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Địa chỉ: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="address" name="address"
                                    value="{{ $supplier->address }}" placeholder="Nhập địa chỉ">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a class="btn btn-danger" href="{{ route('suppliers.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
