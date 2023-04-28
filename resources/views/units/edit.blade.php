@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="card-title">
                    <h4>Chỉnh sửa loại hàng</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="input-sizes">
                    {{-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form action="{{ route('units.update', $unit->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Tên đơn vị: <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" value="{{ $unit->unit_name }}"
                                    id="unit_name" name="unit_name" placeholder="Nhập tên đơn vị">
                                @error('unit_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 text-right">
                                Mô tả:
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-sm" name="description" id="description" placeholder="Nhập tên đơn vị"
                                    style="height: 100px">{{ $unit->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a class="btn btn-danger" href="{{ route('units.index') }}">Trở lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
