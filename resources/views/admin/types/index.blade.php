@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>Danh sách bậc</h1>
            <table class="table table-hover ">
                <a style="float: right" class="btn btn-info" href="{{route('types.create')}}"><i class="fa-solid fa-plus"></i></a>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Tên bậc</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th colspan="3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->description }}</td>
                            @if ($type->status == 1)
                            <td>
                                <form action="{{ route('types.changeStatus', $type->id) }}" method="POST">
                                    @csrf()<button class="btn btn-success" type="submit"><i
                                            class="fa-solid fa-check"></i></button></form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('types.changeStatus', $type->id) }}" method="POST">
                                    @csrf()<button class="btn btn-warning" type="submit"><i
                                            class="fa-solid fa-x"></i></button></form>
                            </td>
                        @endif
                            <td><a class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a class="btn btn-secondary" href="{{route('types.edit',$type->id)}}"><i class="fa-solid fa-pencil"></i></a></td>
                            <td><form action="{{route('types.destroy',$type->id)}}" method="POST">@csrf() @method('DELETE')<button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button ></form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $list_types->links() }}
            </div>

        </div>
    </div>
@endsection
