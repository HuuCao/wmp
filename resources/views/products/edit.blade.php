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
    <form class="form-valide" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control input-sm" value="{{ $product->name_product }}"
                                        id="name_product" name="name_product" placeholder="Nhập tên sản phẩm">
                                    @error('name_product')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="import-price">
                                        Mã SKU <span class="text-danger font-italic">(*)</span>
                                    </label>
                                    <input type="text" class="form-control input-sm" value="{{ $product->sku }}"
                                        id="sku" name="sku" placeholder="Nhập SKU">
                                    @error('sku')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="barcode">Mã vạch / Barcode</label>
                                    <input type="number" class="form-control input-sm" value="{{ $product->barcode }}"
                                        id="barcode" name="barcode" placeholder="Nhập mã">
                                    @error('barcode')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="quantity">Số lượng</label>
                                    <input type="number" class="form-control input-sm" value="{{ $product->quantity }}"
                                        id="quantity" name="quantity" placeholder="Nhập số lượng">
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="import_price">Giá nhập</label>
                                    <input type="number" class="form-control input-sm"
                                        value="{{ $product->import_price }}" id="import_price" name="import_price"
                                        placeholder="Giá nhập">
                                    @error('import_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="expiration-date">Hạn sử dụng</label>
                                    <input type="date" class="date form-control input-sm"
                                        value="{{ $product->expiration_date }}" id="expiration_date"
                                        name="expiration_date">
                                    @error('expiration_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status">Trạng thái</label>
                                    <select class="js-select2-multi form-control" id="status" name="status">
                                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control input-sm" id="description" name="description" placeholder="Nhập mô tả"
                                        style="height: 70px">{{ $product->description }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Hình ảnh</label>
                                <input type="file" class="form-control-file border" name="image" id="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img id="output_image"
                                    src="{{ asset('storage/' . $product->image) }}" width="15%" />
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
                                        <select class="js-select2-multi form-control" name="unit" id="unit">
                                            <option selected value="">-- Chọn --</option>
                                            @foreach ($units as $unit)
                                                <option @if ($product->unit_id == $unit->id) selected @endif
                                                    value="{{ $unit->id }}">
                                                    {{ $unit->unit_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createUnitModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                    @error('unit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="category">Loại sản phẩm</label>
                                    <div style="display: flex">
                                        <select class="js-select2-multi form-control" name="category" id="category">
                                            <option selected value="">-- Chọn --</option>
                                            @foreach ($categories as $category)
                                                <option @if ($product->category_id == $category->id) selected @endif
                                                    value="{{ $category->id }}">
                                                    {{ $category->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createCategoryModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                    @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="supplier">Nhà cung cấp</label>
                                    <div style="display: flex">
                                        <select class="js-select2-multi form-control" name="supplier" id="supplier">
                                            <option selected value="">-- Chọn --</option>
                                            @foreach ($suppliers as $supplier)
                                                <option @if ($product->supplier_id == $supplier->id) selected @endif
                                                    value="{{ $supplier->id }}">
                                                    {{ $supplier->supplier_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createSuppierModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                    @error('supplier')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="shelves">Kệ hàng</label>
                                    <div style="display: flex">
                                        <select class="js-select2-multi form-control" name="shelves" id="shelves">
                                            <option selected value="">-- Chọn --</option>
                                            @foreach ($shelves as $shevle)
                                                <option @if ($product->shelves_id == $shevle->id) selected @endif
                                                    value="{{ $shevle->id }}">
                                                    {{ $shevle->shelves_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#createShelvesModal">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                    @error('shelves')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
    <div class="modal fade" id="createUnitModal" tabindex="-1" role="dialog" aria-labelledby="createUnitLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUnitModalLabel">Thêm đơn vị</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="unitForm" method="POST" action="{{ route('units.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="unit-name">Tên đơn vị</label>
                            <input type="text" class="form-control input-sm" value="{{ old('unit_name') }}"
                                name="unit_name" id="unit_name">
                            @error('unit_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="unit-description">Mô tả</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Popup thêm mới loại sản phẩm --}}
    <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="createCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryLabel">Thêm loại hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="categoryForm" method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="unit-name">Tên loại hàng</label>
                            <input type="text" class="form-control input-sm" value="{{ old('name_category') }}"
                                name="name_category" id="name_category">
                            @error('name_category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Popup thêm mới nhà cung cấp --}}
    <div class="modal fade" id="createSuppierModal" tabindex="-1" role="dialog" aria-labelledby="createSuppierLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSuppierLabel">Thêm nhà cung cấp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="supplierForm" method="POST" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tax_code">Mã số thuế</label>
                            <input type="text" class="form-control input-sm" id="tax_code" name="tax_code"
                                value="{{ old('tax_code') }}" placeholder="Nhập mã số thuế">
                            @error('tax_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="supplier_name">Tên nhà cung cấp</label>
                            <input type="text" class="form-control input-sm" id="supplier_name" name="supplier_name"
                                value="{{ old('supplier_name') }}" placeholder="Nhập tên nhà cung cấp">
                            @error('supplier_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control input-sm" id="phone" name="phone"
                                value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control input-sm" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Nhập email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control input-sm" id="address" name="address"
                                value="{{ old('address') }}" placeholder="Nhập địa chỉ">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Popup thêm mới kệ hàng --}}
    <div class="modal fade" id="createShelvesModal" tabindex="-1" role="dialog" aria-labelledby="createShelvesLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createShelvesLabel">Thêm kệ hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="shelvesForm" method="POST" action="{{ route('shelves.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="shelves-name">Tên kệ hàng</label>
                            <input type="text" class="form-control input-sm" value="{{ old('shelves_name') }}"
                                name="shelves_name" id="shelves_name">
                            @error('shelves_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location">Vị trí</label>
                            <input type="text" class="form-control input-sm" value="{{ old('location') }}"
                                name="location" id="location">
                            @error('location')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shelves_description">Mô tả</label>
                            <textarea class="form-control" name="shelves_description" id="shelves_description" rows="3">{{ old('shelves_description') }}</textarea>
                            @error('shelves_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
