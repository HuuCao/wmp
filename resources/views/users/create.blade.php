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
                    <form class="form-valide" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-username">
                                Username: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Username">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-email">
                                Email: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-password">
                                Password: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control input-sm" id="password" name="password"
                                    value="{{ old('password') }}" placeholder="Password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-password-confirm">
                                Confirm Password: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control input-sm" id="confirm-password"
                                    name="confirm-password" value="{{ old('confirm-password') }}"
                                    placeholder="Confirm password">
                                @error('confirm-password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right" for="val-role">
                                Role: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select name="roles" class='js-select2-multi form-control'>
                                    <option value="">-- Chọn --</option>
                                    @foreach ($roles as $role)
                                        @if ($role->name != null)
                                            <option @if (request()->roles == $role->name) selected @endif
                                                value="{{ $role->name }}"> {{ $role->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a class="btn btn-danger" href="{{ route('users.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!} --}}

@endsection
