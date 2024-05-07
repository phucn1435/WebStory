@extends('home')
@section('header_name')
    Sửa danh mục
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
    <form action="{{ route('danhmuc.update', [$dataEdit->ID]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (session('msg'))
            <div class="alert alert-success text-center">
                {{ session('msg') }}
            </div>
        @endif
       
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" value="{{ $dataEdit->tendanhmuc }}" name="tendanhmuc" id="slug" aria-describedby="emailHelp">
        </div>
        @error('tendanhmuc')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Slug danh mục</label>
            <input type="text" class="form-control" value="{{ $dataEdit->slug_danhmuc }}" onkeyup="ChangeToSlug();" id="convert_slug" name="slug_danhmuc" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Mô tả danh mục</label>
            <input type="text" value="{{ $dataEdit->mota }}" class="form-control" name="mota" id="exampleInputEmail2" aria-describedby="emailHelp">
        </div>
        @error('mota')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail3" class="form-label">Trạng thái</label>
            <select id="exampleInputEmail3" class="form-select" name="trangthai" aria-label="Default select example">
                <option {{ $dataEdit->trangthai == 0 ? 'selected' : false }} value="0">Kích hoạt</option>
                <option {{ $dataEdit->trangthai == 1 ? 'selected' : false }} value="1">Không kích hoạt</option>  
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
