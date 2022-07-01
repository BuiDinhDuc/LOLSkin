@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container">
                <h1>Tạo mới vũ trụ</h1>

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
                <form class="col-md-6 " action="{{ route('universes.update',$universe->id) }}" method="POST">
                    @method('PUT')
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên vũ trụ</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$universe->name}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea rows="5" class="form-control" id="description" name="description">{{$universe->description}}</textarea>
                    </div>
                    <br />

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
