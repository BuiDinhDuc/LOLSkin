@extends('welcome')
@section('content')
    <div class="container">

        @foreach ($list_types as $type)
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $type->name }}</h5>
                    <p class="card-text">{{ $type->description }}</p>
                    <a href="{{route('user.types.detail',$type->id)}}" class="btn btn-primary">Xem các trang phục thuộc bộ</a>
                </div>
            </div>
            <br />
        @endforeach

        <div>
            {!! $list_types->links() !!}
        </div>

    </div>
@endsection
