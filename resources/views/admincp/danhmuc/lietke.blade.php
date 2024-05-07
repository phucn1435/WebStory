@extends('home')
@section('header_name')
    Liệt kê danh mục
@endsection

@section('content1')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên danh mục</th>
        <th scope="col">Slug danh mục</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Quản lý</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        @foreach ($danhmuctruyen as $item)
            <tr>
                <th scope="row"><?=++$i;?></th>
                <td>{{ $item->tendanhmuc }}</td>
                <td>{{ $item->slug_danhmuc }}</td>
                <td>{{ $item->mota }}</td>
                <td>
                    {!! $item->trangthai == 0 ? '<span style="color: green;">Kích hoạt</span>' : '<span style="color: red;">Chưa kích hoạt</span>' !!}
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('danhmuc.edit', [$item->ID]) }}">Edit</a>
                    <form action="{{ route('danhmuc.destroy', ['danhmuc' => $item->ID]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Are you sure?');" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
    
@endsection