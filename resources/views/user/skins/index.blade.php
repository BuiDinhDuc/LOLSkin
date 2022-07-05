@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
        @foreach ($list_skins as $skin)
        <div class="col-3 mb-3" style="display: flex">
            <div class="card" style="width:100%">
                <div class="card-body"  style="display: flex;flex-direction: column;justify-content: space-between;">
                    <img class="card-img-top" src="{{$skin->image}}" style="width: 100% !important;height: auto !important;">
                    <h5 class="card-title">{{ $skin->name }}</h5>
                    <a href="{{route('user.skins.detail',$skin->id)}}" class="btn btn-primary">Xem trang phục </a>
                </div>
            </div>
        </div>
            <br />
        @endforeach
    </div>
        <div>
            {!! $list_skins->links() !!}
        </div>

    </div>
@endsection
