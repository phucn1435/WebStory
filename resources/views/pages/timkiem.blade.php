@extends('../layout')
{{-- @section('slide')
    @include('pages.slide')
@endsection --}}

@section('content')

<div class="album py-5 bg-light">
  <div class="container">
    <div style="text-align: right" class=""> 
      <a class="btn btn-success" href="#">Xem tất cả</a>
    </div>
    @php
        $count = count($truyen);
    @endphp
    <div class="row">
        @if ($count > 0)
            @foreach ($truyen as $item)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img style="width: 100%; height: 200px; object-fit: contain;" class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" >
                    <div class="card-body">
                    <h5>{{$item->tentruyen}}</h5>
                    <p class="card-text">{{ $item->mota }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        <a href="{{ url('xem-truyen/'.$item->slug_truyen) }}" type="button" class="btn btn-sm btn-danger">Đọc ngay</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>515151</button>
                        </div>
                        <small class="text-muted">9 mins ago</small>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p>Truyện đang được cập nhật</p>
        @endif
        
    </div>
  </div>
</div>
@endsection