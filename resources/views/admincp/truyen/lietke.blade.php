@extends('home')
@section('header_name')
    Liệt kê truyện
@endsection

@section('content1')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên truyện</th>
        <th scope="col">Slug truyện</th>
        <th scope="col">Tên danh mục truyện</th>
        <th scope="col">Tên thể loại truyện</th>
        <th scope="col">Loại truyện</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Tóm tắt</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Ngày tạo</th>
        <th scope="col">Ngày cập nhật</th>

        <th scope="col">Quản lý</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        @foreach ($list_truyen as $item)
            <tr>
                <th scope="row"><?=++$i;?></th>
                <td>{{ $item->tentruyen }}</td>
                <td>{{ $item->slug_truyen }}</td>
                <td>
                    @foreach ($item->thuocnhieudanhmuctruyen as $item1)
                        <p style="text-align: center; padding: 3px 1px; background: #33afe7; border-radius: 7px;">{{ $item1->tendanhmuc }}</p>
                    @endforeach
                </td>
                <td>
                    @foreach ($item->thuocnhieutheloaitruyen as $item1)
                        <p style="text-align: center; padding: 3px 1px; background: #33afe7; border-radius: 7px;">{{ $item1->tentheloai }}</p>
                    @endforeach
                </td>
                <td style="width: 15%">
                    
                    @if ($item->loaitruyen == 0)
                    <form action="">
                        @csrf
                    <select class="form-select loaitruyen" data-truyen_id = "{{ $item->ID }}" aria-label="Default select example">
                        <option value="0" selected>Truyện mới</option>
                        <option value="1">Truyện nổi bật</option>
                        <option value="2">Truyện hot</option>
                    </select>
                    </form>
                    @elseif($item->loaitruyen == 1)
                    <form action="">
                        @csrf
                    <select class="form-select loaitruyen" data-truyen_id = "{{ $item->ID }}" aria-label="Default select example">
                        <option value="0" selected>Truyện mới</option>
                        <option selected value="1">Truyện nổi bật</option>
                        <option value="2">Truyện hot</option>
                    </select>
                    </form>
                    @else
                    <form action="">
                        @csrf
                    <select class="form-select loaitruyen" data-truyen_id = "{{ $item->ID }}" aria-label="Default select example">
                        <option value="0" selected>Truyện mới</option>
                        <option value="1">Truyện nổi bật</option>
                        <option selected value="2">Truyện hot</option>
                    </select>
                    </form>
                    @endif
                </td>
                <td><img src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" style="border-radius: 50%;" alt="" height="50" width="50" srcset=""></td>
                <td>{{ $item->mota }}</td>
                <td>
                    {!! $item->trangthai == 0 ? '<span style="color: green;">Kích hoạt</span>' : '<span style="color: red;">Chưa kích hoạt</span>' !!}
                </td>
                <td>
                    {{ $item->created_at }} - {{ $item->created_at->diffForHumans() }}
                </td>
                <td>
                    @if ($item->updated_at != '')
                    {{ $item->updated_at }} - {{ $item->updated_at->diffForHumans() }}
                    @endif
                   
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('truyen.edit', [$item->ID]) }}">Edit</a>
                    <form action="{{ route('truyen.destroy', ['truyen' => $item->ID]) }}" method="POST">
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