@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>Danh sách tướng</h1>
            <table class="table table-hover ">
                <a style="float: right" class="btn btn-info" href="{{route('champions.create')}}"><i class="fa-solid fa-plus"></i></a>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên tướng</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th colspan="3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_champions as $champion)
                        <tr>
                            <td>{{ $champion->id }}</td>
                            <td><img src="{{$champion->image}}"></td>
                            <td>{{ $champion->name }}</td>

                            <td>{{ $champion->price }}</td>
                            @if ($champion->status == 1)
                            <td>
                                <form action="{{ route('champions.changeStatus', $champion->id) }}" method="POST">
                                    @csrf()<button class="btn btn-success" type="submit"><i
                                            class="fa-solid fa-check"></i></button></form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('champions.changeStatus', $champion->id) }}" method="POST">
                                    @csrf()<button class="btn btn-warning" type="submit"><i
                                            class="fa-solid fa-x"></i></button></form>
                            </td>
                        @endif
                            <td><a class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a class="btn btn-secondary" href="{{route('champions.edit',$champion->id)}}"><i class="fa-solid fa-pencil"></i></a></td>
                            <td><form action="{{route('champions.destroy',$champion->id)}}" method="POST">@csrf() @method('DELETE')<button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button ></form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $list_champions->links() }}
            </div>

        </div>
    </div>
@endsection
