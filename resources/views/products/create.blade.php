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
    <form class="form-valide" action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="row">
                        <div class="card-title">
                            <h4>Nhập thông tin</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-sizes">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name_product">
                                        Tên sản phẩm <span class="text-danger font-italic">(*)</span>
                                    </label>
                                    <input type="text" class="form-control input-sm" id="name_product"
                                        placeholder="Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="import-price">
                                        Mã SKU <span class="text-danger font-italic">(*)</span>
                                    </label>
                                    <input type="text" class="form-control input-sm" id="sku" name="sku"
                                        placeholder="Nhập SKU">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="barcode">Mã vạch / Barcode</label>
                                    <input type="number" class="form-control input-sm" id="barcode" name="barcode"
                                        placeholder="Nhập mã">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="quantity">Số lượng</label>
                                    <input type="number" class="form-control input-sm" id="quantity"
                                        placeholder="Nhập số lượng">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="import_price">Giá nhập</label>
                                    <input type="number" class="form-control input-sm" id="import_price"
                                        placeholder="Giá nhập">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="expiry">Hạn sử dụng</label>
                                    <input type="date" class="form-control input-sm" id="expiry">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status">Trạng thái</label>
                                    <select class="js-select2-multi form-control" id="status">
                                        <option>Active</option>
                                        <option>Deactivated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control input-sm" name="description" id="description" placeholder="Nhập mô tả"
                                        style="height: 70px">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Hình ảnh</label>
                                <input type="file" class="form-control-file border" id="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="row">
                        <div class="card-title">
                            <h4>Phân loại</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-sizes">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="unit">Đơn vị tính</label>
                                    <div style="display: flex">
                                        <select class="js-select2-multi form-control" id="unit">
                                            <option selected>-- Chọn --</option>
                                            <option>kg</option>
                                            <option>grams</option>
                                            <option>liters</option>
                                            <option>milliliters</option>
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createUnitModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="product-type">Loại sản phẩm</label>
                                    <div style="display: flex">
                                        <select class="js-select2-multi form-control" id="product-type">
                                            <option selected>-- Chọn --</option>
                                            <option>Category 1</option>
                                            <option>Category 2</option>
                                            <option>Category 3</option>
                                            <option>Category 4</option>
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createUnitModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="supplier">Nhà cung cấp</label>
                                    <div style="display: flex">
                                        <select class="js-select2-multi form-control" id="supplier">
                                            <option selected>-- Chọn --</option>
                                            <option>Supplier 1</option>
                                            <option>Supplier 2</option>
                                            <option>Supplier 3</option>
                                            <option>Supplier 4</option>
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createUnitModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">Thêm</button>
                <a class="btn btn-danger" href="{{ route('products.index') }}">Trở lại</a>
            </div>
        </div>
    </form>

    {{-- Popup thêm mới đơn vị --}}
    <div class="modal fade" id="createUnitModal" tabindex="-1" role="dialog" aria-labelledby="createUnitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUnitModalLabel">Create New Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="unit-name">Unit Name</label>
                            <input type="text" class="form-control" id="unit-name" placeholder="Enter unit name">
                        </div>
                        <div class="form-group">
                            <label for="unit-description">Unit Description</label>
                            <textarea class="form-control" id="unit-description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createUnitBtn">Create Unit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
