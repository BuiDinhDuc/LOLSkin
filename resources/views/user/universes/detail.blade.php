@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($list_categories as $category)
                <div class="col-3" style="display: flex">
                    <div class="card" style="">
                        <div class="card-body"
                            style="display: flex;flex-direction: column;justify-content: space-between;">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <a  href="{{route('user.categories.detail',$category->id)}}" class="btn btn-primary">Xem các trang phục trong bộ</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div>
                {!! $list_categories->links() !!}
            </div>
        </div>
    </div>
@endsection
