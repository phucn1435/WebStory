<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">HP.com</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Trang chủ</a>
          </li>
         
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Danh mục truyện
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              {{-- {{ dd($danhmuc); }} --}}
              @foreach ($danhmuc as $item)
                <li><a class="dropdown-item" href="{{ url('danh-muc/'.$item->slug_danhmuc) }}">{{ $item->tendanhmuc }}</a></li>     
              @endforeach 
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Thể loại truyện
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($theloai as $item)
                <li><a class="dropdown-item" href="{{ url('the-loai/'.$item->slug_theloai) }}">{{ $item->tentheloai }}</a></li>
              @endforeach
            </ul>
          </li>

        </ul>
        <select style="width: 20%; margin-right: 10px;" class="form-select" aria-label="Disabled select example" id="switch_theme_color">
          <option value="xam" selected>Select theme color</option>
          <option value="den">Đen</option>

        </select>
        <form autocomplete="off" method="POST" class="d-flex" action="{{ route('timkiem') }}">
          @csrf
          <input class="form-control me-2" type="search" id="keywords" name="tukhoa" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <div class="" id="search_ajax"></div> 
        </form>
      </div>
    </div>
  </nav>