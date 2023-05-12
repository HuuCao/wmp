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
    <div class="container">
        <h2>Product Search</h2>
        <input type="text" id="search-input" class="form-control" placeholder="Enter product name">
        <ul id="search-results"></ul>
    </div>
    <div class="container">
        <h2>Selected Products</h2>
        <table id="product-table" class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="product-list">
                <!-- Selected products will be dynamically added here -->
            </tbody>
        </table>
    </div>
@endsection
