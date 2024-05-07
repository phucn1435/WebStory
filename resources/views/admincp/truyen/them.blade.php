@extends('home')
@section('header_name')
    Thêm truyện
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
    <form action="{{ route('truyen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (session('msg'))
            <div class="alert alert-success text-center">
                {{ session('msg') }}
            </div>
        @endif
       
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên truyện sách</label>
            <input type="text" class="form-control" name="tentruyen" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp">
        </div>
        @error('tendanhmuc')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Slug truyện</label>
            <input id="convert_slug" type="text" class="form-control" name="slug_truyen" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên tác giả</label>
            <input type="text" class="form-control" name="tentacgia" aria-describedby="emailHelp">
        </div>
        @error('tentacgia')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
            <input type="text" class="form-control" name="tukhoa" aria-describedby="emailHelp">
        </div>


        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Tóm tắt truyện</label>
            <textarea name="tomtat" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        @error('mota')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Hình ảnh truyện</label>
            <input type="file" name="hinhanh" class="form-control-file">
        </div>

        <div class="mb-3">
            <label for="">Truyện nổi bật/hot</label>
            <select class="form-select" aria-label="Default select example" id="loaitruyen" name="loaitruyen">
                <option value="0" selected>Truyện mới</option>
                <option value="1">Truyện nổi bật</option>
                <option value="2">Truyện hot</option>
              </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Danh mục truyện</label> <br>
            {{-- <select class="form-select" name="danhmuctruyen" id="">
                @foreach ($danhmuctruyen as $item)
                    <option value="{{ $item->ID }}">{{ $item->tendanhmuc }}</option>
                @endforeach
            </select> --}}
            <div class="form-check form-check-inline">
                @foreach ($danhmuctruyen as $item)
                    <input class="form-check-input" name="danhmuctruyen[]" type="checkbox" id="{{ $item->ID }}" value="{{ $item->ID }}">
                    <label class="form-check-label" for="{{ $item->ID }}">{{ $item->tendanhmuc }}</label> <br> 
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Thể loại truyện</label> <br>
            <div class="form-check form-check-inline">
                @foreach ($theloaitruyen as $item)
                    <input class="form-check-input" name="theloai[]" type="checkbox" id="{{ $item->ID }}" value="{{ $item->ID }}">
                    <label class="form-check-label" for="{{ $item->ID }}">{{ $item->tentheloai }}</label> <br> 
                @endforeach
            </div>
        </div>
        @error('theloai')
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
