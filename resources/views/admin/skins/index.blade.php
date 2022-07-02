@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>Trang phục</h1>


            <table class="table table-hover ">
                <a style="float: right" class="btn btn-info" href="{{ route('skins.create') }}"><i
                        class="fa-solid fa-plus"></i></a>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên trang phục</th>
                        <th>Tướng</th>
                        <th>Bộ</th>
                        <th>Bậc</th>
                        <th>Mô tả</th>
                        <th>Giá (RP)</th>
                        <th>Trạng thái</th>
                        <th colspan="3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_skins as $skin)
                        <tr>
                            <td>{{ $skin->id }}</td>
                            <td><img src="{{ $skin->image }}"></td>
                            <td>{{ $skin->name }}</td>
                            <td>{{ $skin->champion != null ? $skin->champion->name : '' }}</td>
                            <td>{{ $skin->category != null ? $skin->category->name : '' }}</td>
                            <td>{{ $skin->type->name != null ? $skin->type->name : '' }}</td>
                            <td>{{ $skin->description }}</td>
                            <td>{{ $skin->price }}</td>

                            @if ($skin->status == 1)
                            <td>
                                <form action="{{ route('skins.changeStatus', $skin->id) }}" method="POST">
                                    @csrf()<button class="btn btn-success" type="submit"><i
                                            class="fa-solid fa-check"></i></button></form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('skins.changeStatus', $skin->id) }}" method="POST">
                                    @csrf()<button class="btn btn-warning" type="submit"><i
                                            class="fa-solid fa-x"></i></button></form>
                            </td>
                        @endif

                            <td><a class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a class="btn btn-secondary" href="{{ route('skins.edit', $skin->id) }}"><i
                                        class="fa-solid fa-pencil"></i></a></td>
                            <td>
                                <form action="{{ route('skins.destroy', $skin->id) }}" method="POST">@csrf()
                                    @method('DELETE')<button class="btn btn-danger" type="submit"><i
                                            class="fa-solid fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $list_skins->links() }}
            </div>

        </div>
    </div>
@endsection
