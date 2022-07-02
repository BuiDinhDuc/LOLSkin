@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="container">
                <h1>Tạo mới bộ</h1>

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
                <form class="col-md-6 " action="{{ route('categories.store') }}" method="POST">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên bộ</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <br/>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="universe">Tên vũ trụ</label>
                        </div>
                        <select class="custom-select" id="universe" name="universe">
                            @foreach ($list_universes as $universe )
                            <option value="{{$universe->id}}">{{$universe->name}}</option>
                        @endforeach
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <br />

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
