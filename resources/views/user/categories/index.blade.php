@extends('welcome')
@section('content')
    <div class="container">

        @foreach ($list_categories as $category)
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <a href="{{route('user.categories.detail',$category->id)}}" class="btn btn-primary">Xem các trang phục thuộc bộ</a>
                </div>
            </div>
            <br />
        @endforeach

        <div>
            {!! $list_categories->links() !!}
        </div>

    </div>
@endsection
