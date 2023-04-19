@extends('layouts.app')


@section('content')
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


    {{-- <form action="{{ route('products.store') }}" method="POST">
        @csrf


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form> --}}

    <form action="{{ route('products.store') }}" method="POST">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Vertical Form</h4> --}}
                    <div class="basic-form">
                        <form>
                            <div class="form-row">
                                <div class="form-group input-default col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group input-default col-md-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control input-default" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" class="form-control input-default" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control input-default">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>State</label>
                                    <select id="inputState" class="form-control input-default">
                                        <option selected="selected">Choose...</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Zip</label>
                                    <input type="text" class="form-control input-default">
                                </div>
                            </div>
                            <div class="form-group">
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


@endsection
