@extends('welcome')
@section('content')
    <div class="container">

        <img src="{{ $skin->big_image }}" style="width: 100% !important; height:auto !important">

        <br />
        <br />
        <div class="row">
            <div> <b>Tên : </b><span>{{ $skin->name }}</span></div>
            <div> <b>Mô tả : </b><span>{{ $skin->description }}</span></div>
            <div> <b>Bậc : </b><a href="{{ route('user.types.detail', $skin->type_id) }}">{{ $skin->type->name }}</a></div>
            <div> <b>Bộ : </b><a
                    href="{{ route('user.categories.detail', $skin->category_id) }}">{{ $skin->category->name }}</a></div>
            <div> <b>Tướng : </b><a
                    href="{{ route('user.champions.detail', $skin->champion_id) }}">{{ $skin->champion->name }}</a></div>
            <div> <b>Giá : </b><span>{{ $skin->price }} RP</span></div>

        </div>
    </div>
@endsection
