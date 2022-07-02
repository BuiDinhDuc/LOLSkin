@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="container">
                <h1>Cập nhật bộ</h1>

                @if (isset($msg) && $msg == true)
                    <div class="alert alert-success" role="alert">
                        Thành công
                    </div>
                @elseif(isset($msg) && $msg == false)
                    <div class="alert alert-danger" role="alert">
                        Thất bại
                    </div>
                @endif
                <br />
                <form class="col-md-6 " action="{{ route('categories.update', $category->id) }}" method="POST">
                    @method('PUT')
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên bộ</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $category->name }}">
                    </div>
                    <br />
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="universe">Tên vũ trụ</label>
                        </div>
                        <select class="custom-select" id="universe" name="universe">
                            @foreach ($list_universes as $universe)
                                @if ($universe->id == $category->universe_id)
                                    <option selected value="{{ $universe->id }}">{{ $universe->name }}</option>
                                @else
                                    <option value="{{ $universe->id }}">{{ $universe->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
                    </div>
                    <br />

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
