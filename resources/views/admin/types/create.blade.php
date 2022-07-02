@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="container">
                <h1>Tạo mới bậc</h1>

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
                <form class="col-md-6 " action="{{ route('types.store') }}" method="POST">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên bậc</label>
                        <input type="text" class="form-control" id="name" name="name">
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
