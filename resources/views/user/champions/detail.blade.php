@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div><h2><b> Tướng : </b><span> {{$champion->name}}</span></h2></div>
            {{-- <div><h4><b> Mô tả : </b><span> {{$champion->description}}</span></h4></div> --}}
            <hr>
        </div>
        <div class="row">

            <div><h4>Danh sách trang phục</h4></div>

        </div>
        <div class="row">
            @foreach ($list_skins as $skin)

                <div class="col-3 mb-3" style="display: flex">
                    <div class="card" style="">
                        <img class="card-img-top" src="{{$skin->image}}">
                        <div class="card-body" style="display: flex;flex-direction: column;justify-content: space-between;">
                            <h5 class="card-title">{{ $skin->name }}</h5>
                            <p class="card-text">{{ $skin->description }}</p>
                            <a href="#" class="btn btn-primary">Xem trang phục</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div>
                {!! $list_skins->links() !!}
            </div>
        </div>
    </div>
@endsection
