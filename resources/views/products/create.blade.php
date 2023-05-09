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
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="row">
                <div class="card-title mx-auto">
                    <h4>Nhập thông tin</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="input-sizes">
                    <form class="form-valide" action="{{ route('products.store') }}" method="POST">
                        @csrf
                        {{-- <div class="form-group row">

                            <div class="col-4">
                                <label>
                                    Mã sản phẩm: <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-sm" id="summary_code" name="summary_code"
                                    value="{{ old('summary_code') }}" placeholder="Nhập mã sản phẩm">
                                @error('summary_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label>
                                    Tên sản phẩm: <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-sm" id="name_product" name="name_product"
                                    value="{{ old('name_product') }}" placeholder="Nhập tên sản phẩm">
                                @error('name_product')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label>
                                    Giá nhập: <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-sm" id="import_price" name="import_price"
                                    value="{{ old('import_price') }}" placeholder="Nhập giá nhập">
                                @error('import_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4">Mô tả: <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-sm" name="description" id="description" placeholder="Nhập tên loại hàng"
                                    style="height: 100px">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a class="btn btn-danger" href="{{ route('products.index') }}">Trở lại</a>
                            </div>
                        </div> --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="product-code">Product Code</label>
                                <input type="text" class="form-control input-sm" id="product-code"
                                    placeholder="Enter product code">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product-name">Product Name</label>
                                <input type="text" class="form-control input-sm" id="product-name"
                                    placeholder="Enter product name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="import-price">Import Price</label>
                                <input type="number" class="form-control input-sm" id="import-price"
                                    placeholder="Enter import price">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control input-sm" id="quantity" placeholder="Enter quantity">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="expiry">Expiry</label>
                                <input type="date" class="form-control input-sm" id="expiry">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select class="js-select2-multi form-control" id="status">
                                    <option>Active</option>
                                    <option>Deactivated</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="unit">Unit</label>
                                <select class="js-select2-multi form-control" id="unit">
                                    <option selected>Choose...</option>
                                    <option>kg</option>
                                    <option>grams</option>
                                    <option>liters</option>
                                    <option>milliliters</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#createUnitModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product-type">Product Type</label>
                                <select class="js-select2-multi form-control" id="product-type">
                                    <option selected>Choose...</option>
                                    <option>Category 1</option>
                                    <option>Category 2</option>
                                    <option>Category 3</option>
                                    <option>Category 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

{{-- @section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form>
                            <div class="form-group row">
                                <div class="form-group input-sm col-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control input-sm" placeholder="Email">
                                </div>
                                <div class="form-group input-sm col-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control input-sm" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>
                                    Tên loại hàng: <span class="text-danger">*</span>
                                </label>
                                <div class="col-6">
                                    <input type="text" class="form-control input-sm" id="name_category"
                                        name="name_category" value="{{ old('name_category') }}"
                                        placeholder="Nhập tên loại hàng">
                                    @error('name_category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Address 2</label>
                                <input type="text" class="form-control input-sm"
                                    placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control input-sm">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>State</label>
                                    <select id="inputState" class="form-control input-sm">
                                        <option selected="selected">Choose...</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Zip</label>
                                    <input type="text" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Check me out</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product-code">Product Code:</label>
            <input type="text" class="form-control" id="product-code">
        </div>
        <div class="form-group">
            <label for="product-name">Product Name:</label>
            <input type="text" class="form-control" id="product-name">
        </div>
        <div class="form-group">
            <label for="input-price">Input Price:</label>
            <input type="text" class="form-control" id="input-price">
        </div>
        <div class="form-group">
            <label for="export-price">Export Price:</label>
            <input type="text" class="form-control" id="export-price">
        </div>
        <div class="form-group">
            <label for="unit-of-measure">Unit of Measure:</label>
            <select class="form-control" id="unit-of-measure">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
                <option>Option 5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
                <option>Option 5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select class="form-control" id="type">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
                <option>Option 5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="manufacture-date">Date of Manufacture:</label>
            <input type="date" class="form-control" id="manufacture-date">
        </div>
        <div class="form-group">
            <label for="expiry-date">Expiry Date:</label>
            <input type="date" class="form-control" id="expiry-date">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="status">
            <label class="form-check-label" for="status">Status</label>
        </div>
        <div class="form-group">
            <label for="images">Images:</label>
            <input type="file" class="form-control-file" id="images">
        </div>
        <div class="form-group">
            <label for="shelf">Shelf:</label>
            <select class="form-control" id="shelf">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
                <option>Option 5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


@endsection --}}
