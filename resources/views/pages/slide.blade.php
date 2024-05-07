<div class="owl-carousel owl-theme">
  @foreach ($truyen as $item)
    <a href="{{ url('xem-truyen/'.$item->slug_truyen) }}" style="text-decoration: none;" class="item">
      <img src="{{ asset('Assets/image/HinhAnhTruyen/' .$item->hinhanh) }}" alt="">
      <h3>{{ $item->tentruyen }}</h3>
      <p><i class="fas fa-eye"></i>{{ $item->luotxem }}</p>
    </a>
  @endforeach
</div>