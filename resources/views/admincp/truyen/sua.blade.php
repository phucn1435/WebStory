@extends('home')
@section('header_name')
    Sửa truyện
@endsection


@section('content1')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="color: red;">
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('truyen.update', [$dataEdit->ID]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (session('msg'))
            <div class="alert alert-success text-center">
                {{ session('msg') }}
            </div>
        @endif
       
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên truyện sách</label>
            <input type="text" value="{{ $dataEdit->tentruyen }}" class="form-control" name="tentruyen" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp">
        </div>
        @error('tendanhmuc')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Slug truyện</label>
            <input id="convert_slug" type="text" value="{{$dataEdit->slug_truyen }}" class="form-control" name="slug_truyen" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Tóm tắt truyện</label>
            <textarea name="tomtat" class="form-control" id="" cols="30" rows="10">{{ $dataEdit->mota }}</textarea>
        </div>
        @error('mota')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Hình ảnh truyện</label> <br>
            <input type="file" name="hinhanh" class="form-control-file" id="fileInput"> <br>
            <img src="{{asset('Assets/image/HinhAnhTruyen/'.$dataEdit->hinhanh)}}" height="200" width="200" alt="">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Danh mục truyện</label>
            <select class="form-select" name="danhmuctruyen" id="">
                @foreach ($danhmuctruyen as $item)
                    <option {{ $item->ID == $dataEdit->danhmuc_id ? 'selected' : false }} value="{{ $item->ID }}">{{ $item->tendanhmuc }}</option>
                @endforeach
            </select>
        </div>
        @error('mota')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail3" class="form-label">Trạng thái</label>
            <select id="exampleInputEmail3" class="form-select" name="trangthai" aria-label="Default select example">
                <option value="0">Kích hoạt</option>
                <option value="1">Không kích hoạt</option>  
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
