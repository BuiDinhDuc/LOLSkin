@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="container">
                <h1>Tạo mới trang phục</h1>

                <br />
                <form class="col-md-6 " action="{{ route('skins.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên trang phục</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <br/>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="champion">Tướng</label>
                        </div>
                        <select class="custom-select" id="champion" name="champion">
                            @foreach ($list_champions as $champion )
                            <option value="{{$champion->id}}">{{$champion->name}}</option>
                        @endforeach
                        </select>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="category">Bộ</label>
                        </div>
                        <select class="custom-select" id="category" name="category">
                            @foreach ($list_categories as $category )
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        </select>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="type">Bậc</label>
                        </div>
                        <select class="custom-select" id="type" name="type">
                            @foreach ($list_types as $type )
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group mb-3">
                        <label for="image">Thumbnail</label>
                        <input class="form-control" id="image" name="image" type="file" accept="image/*">
                    </div>

                    <div class="form-group mb-3">
                        <label for="big_image">Hình ảnh lớn</label>
                        <input class="form-control" id="big_image" name="big_image" type="file" accept="image/*">
                    </div>


                    <div class="form-group mb-3">
                        <label for="price">Giá</label>
                        <input class="form-control" id="price" name="price" type="number">
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
