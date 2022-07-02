@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="container">
                <h1>Cập nhật tướng</h1>

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
                <form class="col-md-6 " action="{{ route('champions.update',$champion->id) }}" method="POST">
                    @method('PUT')
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên tướng</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$champion->name}}">
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input class="form-control" id="price" name="price" type="number" value="{{$champion->price}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Hình ảnh</label>
                        <input class="form-control" id="image" name="image" type="file" accept="image/*" onchange="change(this)">

                        <br/>
                        <img src="{{$champion->image}}" class="img" id="img" alt="">
                    </div>
                    <br />

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
