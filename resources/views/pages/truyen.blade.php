@extends('../layout')
@section('slide')
    {{-- @include('pages.slide') --}}
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
      <li class="breadcrumb-item">{{ $truyen->tentruyen }}</li>
      
    </ol>
</nav>
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div style="border: 5px solid darkred;" class="col-md-3">
                <img class="w-100 img-truyen" src="{{ asset('Assets/image/HinhAnhTruyen/'.$truyen->hinhanh) }}" alt="">
            </div>
            <style type="text/css">
                a {
                    text-decoration: none;
                }
            </style>
            <div class="col-md-9">
                <ul style="list-style: none;">
                    <div class="fb-share-button" data-href="{{\URL::current()}}" data-layout="" data-size=""><a target="_blank" href="{{\URL::current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                    {{-- Lấy biến wishlist --}}
                    <input type="hidden" value="{{ $truyen->tentruyen }}" class="wishlist_title">
                    <input type="hidden" value="{{ \URL::current() }}" class="wishlist_url">
                    <input type="hidden" value="{{ $truyen->ID }}" class="wishlist_id">
                    {{-- End lấy biến wishlist --}}


                    <li>Tên truyện: {{ $truyen->tentruyen }}</li>
                    <li>Ngày đăng: {{ $truyen->created_at->diffForHumans() }}</li>
                    <li>Tác giả: {{ $truyen->tacgia }} </li>
                    <li>Danh mục truyện: @foreach ($truyen->thuocnhieudanhmuctruyen as $item1)
                       <span style="padding: 3px 2px; background: black; color: #fff; margin-left: 5px; border-radius: 7px;"> {{ $item1->tendanhmuc }} </span>
                    @endforeach </li>
                    <li style="margin-top: 5px;">Thể loại: @foreach ($truyen->thuocnhieutheloaitruyen as $item1)
                      <a style="padding: 3px 2px; background: #45b5e7; margin-left: 5px; border-radius: 7px; color: white;" href="{{ url('the-loai/'.$truyen->theloai->slug_theloai) }}">{{ $item1->tentheloai }} </a>
                    @endforeach  
                    </li>
                    <li>Số chapter: {{ count($chapter) }} </li>
                    <li>Số lượt xem: 10 </li>
                    <li><a style="text-decoration: none;" href="#">Xem mục lục</a></li>
                    @if (count($chapter) > 0)
                      <li>
                        <a href="{{ url('xem-chapter/'.$truyen->slug_truyen.'/'.$chapter_dau->slug_chapter) }}" class="btn btn-primary">Đọc online</a>
                        <button class="btn btn-danger btn-thich_truyen"><i class="fa-solid fa-heart"></i> Thích truyện</button>
                      </li>
                      <li class="mt-3"><a href="{{ url('xem-chapter/'.$truyen->slug_truyen.'/'.$chuong_moinhat->slug_chapter) }}" class="btn btn-success">Đọc chương mới nhất</a></li>
                    @else
                      <button class="btn btn-danger" type="button">Hiện không có chương</button>
                    @endif
                </ul>
            </div>
            <div class="col-md-12">
                <p>{{ $truyen->mota }}</p>
            </div>
            <hr>
            <style>
              .tagcloud05 ul {
                margin: 0;
                padding: 0;
                list-style: none;
              }
              .tagcloud05 ul li {
                display: inline-block;
                margin: 0 0 .3em 1em;
                padding: 0;
              }
              .tagcloud05 ul li a {
                position: relative;
                display: inline-block;
                height: 30px;
                line-height: 30px;
                padding: 0 1em;
                background-color: #3498db;
                border-radius: 0 3px 3px 0;
                color: #fff;
                font-size: 13px;
                text-decoration: none;
                -webkit-transition: .2s;
                transition: .2s;
              }
              .tagcloud05 ul li a::before {
                position: absolute;
                top: 0;
                left: -15px;
                content: '';
                width: 0;
                height: 0;
                border-color: transparent #3498db transparent transparent;
                border-style: solid;
                border-width: 15px 15px 15px 0;
                -webkit-transition: .2s;
                transition: .2s;
              }
              .tagcloud05 ul li a::after {
                position: absolute;
                top: 50%;
                left: 0;
                z-index: 2;
                display: block;
                content: '';
                width: 6px;
                height: 6px;
                margin-top: -3px;
                background-color: #fff;
                border-radius: 100%;
              }
              .tagcloud05 ul li span {
                display: block;
                max-width: 100px;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
              }
              .tagcloud05 ul li a:hover {
                background-color: #555;
                color: #fff;
              }
              .tagcloud05 ul li a:hover::before {
                border-right-color: #555;
              }
            </style>
            <div class="col-md-12">
              <p>Từ khóa tìm kiếm: </p>
              @php
                  $tukhoa = explode(",", $truyen->tukhoa);
                  // print_r($tukhoa);
              @endphp
              <div class="tagcloud05">
                <ul>
                  @foreach ($tukhoa as $item)
                    <li><a href="{{ url('tag/'. \Str::slug($item)) }}"><span>{{ $item }}</span></a></li>
                  @endforeach
                </ul>
              </div>
            </div>
           
            <div class="col-md-12">
                <h3>Mục lục</h3>
                <ul>
                    @foreach ($chapter as $item)
                      <li><a href="{{ url('xem-chapter/'.$item->slug_chapter) }}">{{ $item->tieude }}</a></li>
                    @endforeach
                </ul>
            </div>
            <hr>
            <div class="fb-comments" data-href="{{\URL::current()}}" data-width="100%" data-numposts="10"></div>
            <hr>
            <h3>Sách cùng danh mục</h3>
            <div class="class-md-12">
                <div class="row">
                    @foreach ($cungdanhmuc as $item)
                      <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                          <img class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" >
                          <div class="card-body">
                            <h5>{{ $item->tentruyen }}</h5>
                            <p class="card-text">{{ $item->mota }}</p>
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
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>  
    {{-- <div class="col-md-3">
        <h3>Danh mục truyện</h3>
    </div> --}}
    <div class="col-md-3">
      <div class="row">
        {{-- <div class="col-sm-12">
            <h3>danh muc truyen-</h3>
        </div> --}}
        <div class="col-sm-12">
          <h3 style="background: pink; padding: 10px; text-align: center;">Truyện yêu thích</h3>
          <div id="yeuthich"></div>
        </div>
        <div class="col-sm-12 mt-3">
          <h3 style="background: #8282f3; padding: 10px; text-align: center;">Truyện mới</h3>
          <div id="">
            @foreach ($truyen_moi as $item)
              <div class="row mt-2"> 
                <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" alt=""></div>
                  <div class="col-md-7 side-bar">
                      <a href="{{ url('xem-truyen/'.$item->slug_truyen) }}">
                          <p>{{ $item->tentruyen }}</p>
                      </a>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        <div class="col-sm-12 mt-3">
          <h3 style="background: violet; padding: 10px; text-align: center;">Truyện nổi bật</h3>
          <div id="">
            @foreach ($truyen_noibat as $item)
              <div class="row mt-2"> 
                <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" alt=""></div>
                  <div class="col-md-7 side-bar">
                      <a href="{{ url('xem-truyen/'.$item->slug_truyen) }}">
                          <p>{{ $item->tentruyen }}</p>
                      </a>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        <div class="col-sm-12 mt-3">
          <h3 style="background: #fb4848; padding: 10px; text-align: center;">Truyện hot</h3>
          <div id="">
            @foreach ($truyen_hot as $item)
              <div class="row mt-2"> 
                <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="{{ asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh) }}" alt=""></div>
                  <div class="col-md-7 side-bar">
                      <a href="{{ url('xem-truyen/'.$item->slug_truyen) }}">
                          <p>{{ $item->tentruyen }}</p>
                      </a>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
    </div>
  </div>
</div>
<hr>

@endsection