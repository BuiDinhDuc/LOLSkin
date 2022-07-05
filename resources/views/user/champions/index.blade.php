@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
        @foreach ($list_champions as $champion)
            <div class="col-2" style="display: flex">
                <div class="card-body"  style="display: flex;flex-direction: column;justify-content: space-between;">
                    <img class="card-img-top" src="{{$champion->image}}">
                    <h5 class="card-title">{{ $champion->name }}</h5>
                    <a href="{{route('user.champions.detail',$champion->id)}}" class="btn btn-primary">Xem trang phục</a>
                </div>
            </div>
            <br />
        @endforeach
    </div>
        {{-- <div>
            {!! $list_champions->links() !!}
        </div> --}}

    </div>
@endsection
