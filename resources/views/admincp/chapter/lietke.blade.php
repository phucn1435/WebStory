@extends('home')
@section('header_name')
    Liệt kê chapter
@endsection

@section('content1')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên chapter</th>
        <th scope="col">Slug chapter</th>
        <th scope="col">Thuộc truyện</th>
        <th scope="col">Tóm tắt</th>
        <th scope="col">Nội dung</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Quản lý</th>         8
      </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        @foreach ($chapter as $item)
            <tr>
                <th scope="row"><?=++$i;?></th>
                <td>{{ $item->tieude }}</td>
                <td>{{ $item->slug_chapter }}</td>
                <td>{{ $item->tentruyen }}</td>
                <td>{{ $item->tomtat }}</td>
                <td>{{ $item->noidung }}</td>
                <td>
                    {!! $item->trangthai == 0 ? '<span style="color: green;">Kích hoạt</span>' : '<span style="color: red;">Chưa kích hoạt</span>' !!}
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('chapter.edit', $item->ID) }}">Edit</a>
                    <form action="{{ route('chapter.destroy', ['chapter' => $item->ID]) }}" method="POST">
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