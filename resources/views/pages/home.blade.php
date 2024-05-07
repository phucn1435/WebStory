@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection

@section('content')
<style>
  .switch_theme_black {
    background: black;
    color: white;
  }
</style>

<ul class="nav nav-pills" id="myPills" role="tablist">
  @foreach ($danhmuc as $item)
  <form>
    @csrf
  <li class="nav-item click_link" data-danhmuc_id="{{$item->ID}}" role="presentation">
    <a class="nav-link " id="pill-tab-{{ $item->slug_danhmuc }}"  data-bs-toggle="pill" href="#pill-{{ $item->slug_danhmuc }}" role="tab" aria-controls="pill-{{ $item->ID }}" aria-selected="false">{{ $item->tendanhmuc }}</a>
  </li>
</form>
  @endforeach

</ul>

<div class="tab-content" id="myPillsContent">
  @foreach ($danhmuc as $item1)
    <div class="tab-pane fade" id="pill-{{ $item1->slug_danhmuc }}" role="tabpanel" aria-labelledby="pill-tab-{{ $item1->slug_danhmuc }}">
        <p>Danh mục truyện: {{ $item1->tendanhmuc }}</p>
        
          <div class="show_cate_{{ $item1->ID }}">
          
          </div>
        
       
    </div>
  @endforeach
</div>
<hr>
<h3>Tất cả truyện</h3>
<div class="class-md-12">
  <div class="row">
      @foreach ($truyen as $item)
        <div class="col-md-3">
          <div class="card mb-3 box-shadow">
            <img class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" >
            <div class="card-body">
              <h5>{{ $item->tentruyen }}</h5>
              <p class="card-text">{{ $item->mota }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ url('xem-truyen/'.$item->slug_truyen) }}" type="button" class="btn btn-sm btn-danger">Đọc ngay</a>
                  <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>{{ $item->luotxem }}</button>
                </div>
                <small class="text-muted">9 mins ago</small>
              </div>
            </div>
          </div>
        </div>
      @endforeach
  </div>
</div>

{{-- Sách hay xem nhiều --}}
<h3>Sách hay xem nhiều</h3>
<div class="album py-5 bg-light">
  <div class="container">
    <div style="text-align: right" class=""> 
      <a class="btn btn-success" href="#">Xem tất cả</a>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
        <a href="">
            <img class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/banner-001697336981.banner-00.jpg') }}" >
            <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="#" type="button" class="btn btn-sm btn-danger">Đọc ngay</a>
                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>515151</button>
                </div>
                <small class="text-muted">9 mins ago</small>
                </div>
            </div>
        </a>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Blogs --}}
<h3>Blogs</h3>
<div class="album py-5 bg-light">
  <div class="container">
    <div style="text-align: right" class=""> 
      <a class="btn btn-success" href="#">Xem tất cả</a>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/banner-001697336981.banner-00.jpg') }}" >
          <div class="card-body">
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="#" type="button" class="btn btn-sm btn-danger">Đọc ngay</a>
                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>515151</button>
              </div>
              <small class="text-muted">9 mins ago</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection