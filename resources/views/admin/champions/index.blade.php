@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Welcome</h1>
            <table class="table table-hover ">
                <a style="float: right" class="btn btn-info" href="{{route('universes.create')}}"><i class="fa-solid fa-plus"></i></a>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Tên vũ trụ</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th colspan="3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_universes as $universe)
                        <tr>
                            <td>{{ $universe->id }}</td>
                            <td>{{ $universe->name }}</td>
                            <td>{{ $universe->description }}</td>
                            @if ($universe->status == 1)
                                <td><a class="btn btn-success"><i class="fa-solid fa-check"></i></a></td>
                            @else
                                <td><a class="btn btn-warning"><i class="fa-solid fa-x"></i></a></td>
                            @endif
                            <td><a class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a class="btn btn-secondary" href="{{route('universes.edit',$universe->id)}}"><i class="fa-solid fa-pencil"></i></a></td>
                            <td><form action="{{route('universes.destroy',$universe->id)}}" method="POST">@csrf() @method('DELETE')<button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button ></form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $list_universes->links() }}
            </div>

        </div>
    </div>
@endsection
