@extends('home')
@section('header_name')
    Thêm chapter
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
    <form action="{{ route('chapter.update',  [$chapter->ID] ) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (session('msg'))
            <div class="alert alert-success text-center">
                {{ session('msg') }}
            </div>
        @endif
       
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên chapter</label>
            <input type="text" value="{{ $chapter->tieude }}" class="form-control" name="tieude" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp">
        </div>
        @error('tieude')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Slug chapter</label>
            <input id="convert_slug" value="{{ $chapter->slug_chapter }}" type="text" class="form-control" name="slug_chapter"  aria-describedby="emailHelp">
        </div>
        @error('slug_chapter')
            <p style="color: red;">{{ $message }}</p>
        @enderror


        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Tóm tắt</label>
            <input type="text" value="{{ $chapter->tomtat }}" class="form-control" name="tomtat" id="exampleInputEmail2" aria-describedby="emailHelp">
        </div>
        @error('tomtat')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Nội dung</label>
            <textarea name="noidung" class="form-control" id="" cols="30" rows="10">{{ $chapter->noidung }}</textarea>
        </div>
        @error('noidung')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail3" class="form-label">Thuộc truyện</label>
            <select id="exampleInputEmail3" class="form-select" name="thuoctruyen" aria-label="Default select example">
                @foreach ($truyen as $item)
                    <option {{ $item->ID == $chapter->truyen_id ? 'selected' : false }} value="{{$item->ID}}">{{$item->tentruyen}}</option>
                @endforeach
            </select>
        </div>

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
