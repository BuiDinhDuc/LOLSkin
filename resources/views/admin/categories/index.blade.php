@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>Danh sách bộ</h1>

            {{-- {{var_dump($list_categories)}} --}}
            <table class="table table-hover ">
                <a style="float: right" class="btn btn-info" href="{{ route('categories.create') }}"><i
                        class="fa-solid fa-plus"></i></a>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Tên bộ</th>
                        <th>Tên vũ trụ</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th colspan="3">Hành động</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($list_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->universe != null ? $category->universe->name : '' }}</td>
                            <td>{{ $category->description }}</td>
                            @if ($category->status == 1)
                                <td>
                                    <form action="{{ route('categories.changeStatus', $category->id) }}" method="POST">
                                        @csrf()<button class="btn btn-success" type="submit"><i
                                                class="fa-solid fa-check"></i></button></form>
                                </td>
                            @else
                                <td>
                                    <form action="{{ route('categories.changeStatus', $category->id) }}" method="POST">
                                        @csrf()<button class="btn btn-warning" type="submit"><i
                                                class="fa-solid fa-x"></i></button></form>
                                </td>
                            @endif
                            <td><a class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a class="btn btn-secondary" href="{{ route('categories.edit', $category->id) }}"><i
                                        class="fa-solid fa-pencil"></i></a></td>
                            <td>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf() @method('DELETE')<button class="btn btn-danger" type="submit"><i
                                            class="fa-solid fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $list_categories->links() }}
            </div>

        </div>
    </div>
@endsection
