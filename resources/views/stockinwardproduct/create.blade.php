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
    <form class="form-valide" action="{{ route('stockinward.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="card-title">
                            <h4>Nhập thông tin</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-sizes">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="code_inward">
                                        Mã phiếu <span class="text-danger font-italic">(*)</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('stock_inward_code') }}"
                                        id="stock_inward_code" name="stock_inward_code"
                                        placeholder="Hệ thống sẽ tự động tạo mã" readonly>
                                    @error('stock_inward_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="input_day">Ngày nhập kho <span
                                            class="text-danger font-italic">(*)</span></label>
                                    <input type="date" class="date form-control" value="{{ old('input_day') }}"
                                        id="input_day" name="input_day">
                                    @error('input_day')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="user">Người tạo</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->id }}" id="user"
                                        name="user" placeholder="Giá nhập" readonly>
                                    @error('user')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="content">Nội dung nhập kho</label>
                                    <textarea class="form-control" id="content" name="content" placeholder="Nhập nội dung" style="height: 100px">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="note">Ghi chú</label>
                                    <textarea class="form-control" id="note" name="note" placeholder="Nhập ghi chú" style="height: 60px">{{ old('note') }}</textarea>
                                    @error('note')
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="card-title">
                            <h4>Danh sách sản phẩm</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-sizes">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <table id="product-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Đơn vị tính</th>
                                                <th>Nhà cung cấp</th>
                                                <th>Giá nhập</th>
                                                <th>Số lượng</th>
                                                <th>Hạn sử dụng</th>
                                                <th>Tổng tiền</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-list">
                                            <tr>
                                                <td>
                                                    <select name="products[0][product_id]" class="form-control" required>
                                                        <option value="">-- Chọn --</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name_product }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="products[0][unit_id]" class="form-control" required>
                                                        <option value="">-- Chọn --</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </td>
                                                <td>
                                                    <select name="products[0][supplier_id]" class="form-control" required>
                                                        <option value="">-- Chọn --</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">
                                                                {{ $supplier->supplier_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="products[0][import_price]"
                                                        class="form-control price-input" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="products[0][quantity]"
                                                        class="form-control quantity-input" required>
                                                </td>
                                                <td>
                                                    <input type="date" name="products[0][expiration_date]"
                                                        class="form-control" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="products[0][total]"
                                                        class="form-control total-input" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" id="add-product" class="btn btn-primary">Thêm sản phẩm</button>
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
                <a class="btn btn-danger" href="{{ route('stockinward.index') }}">Trở lại</a>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var addProductButton = document.getElementById('add-product');
            var productList = document.getElementById('product-list');
            var productCount = 1;

            addProductButton.addEventListener('click', function() {
                var productRow = document.createElement('tr');
                productRow.innerHTML = `
                    <td>
                        <select name="products[${productCount}][product_id]" class="form-control" required>
                            <option value="">-- Chọn --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name_product }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="products[${productCount}][unit_id]" class="form-control" required>
                            <option value="">-- Chọn --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="products[${productCount}][supplier_id]" class="form-control" required>
                            <option value="">-- Chọn --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="products[${productCount}][import_price]" class="form-control price-input" required>
                    </td>
                    <td>
                        <input type="number" name="products[${productCount}][quantity]" class="form-control quantity-input" required>
                    </td>
                    <td>
                        <input type="date" name="products[${productCount}][expiration_date]" class="form-control" required>
                    </td>
                    <td>
                        <input type="text" name="products[${productCount}][total]" class="form-control total-input" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-remove">Remove</button>
                    </td>
                `;
                productList.appendChild(productRow);
                productCount++;
            });

            productList.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-remove')) {
                    var row = event.target.closest('tr');
                    row.remove();
                }
            });

            productList.addEventListener('input', function(event) {
                if (event.target.classList.contains('quantity-input') || event.target.classList.contains(
                        'price-input')) {
                    var quantity = event.target.closest('tr').querySelector('.quantity-input').value;
                    var price = event.target.closest('tr').querySelector('.price-input').value;
                    var total = quantity * price;
                    event.target.closest('tr').querySelector('.total-input').value = total.toFixed(0);
                }
            });
        });
    </script>
@endsection
