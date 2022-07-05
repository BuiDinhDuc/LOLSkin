@extends('welcome')
@section('content')
    <div class="container">

        @foreach ($list_universes as $universe)
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $universe->name }}</h5>
                    <p class="card-text">{{ $universe->description }}</p>
                    <a href="{{route('user.universes.detail',$universe->id)}}" class="btn btn-primary">Xem các bộ</a>
                </div>
            </div>
            <br />
        @endforeach

        <div>
            {!! $list_universes->links() !!}
        </div>

    </div>
@endsection
