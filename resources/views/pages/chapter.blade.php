@extends('../layout')
{{-- @section('slide')
    @include('pages.slide')
@endsection --}}

@section('content')
<style>
    .isDisable {
        color: currentColor;
        pointer-events: none;
        opacity: 0.5;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Library</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
  </nav>
<div class="row">
    <div class="col-md-12">
        <h2>{{ $truyen->Truyen1->tentruyen }}</h2>
        <p>Chương hiện tại: {{ $chapter->tieude }}</p>
        <p>{{ $chapter->tieude }}</p>
        <div class="col-md-5">
           
            <div class="form-group">
                <label for="">Chọn chương</label> <br>
                <p class="mb-3"><a class="btn btn-primary {{ $chapter->ID === $min_id->ID ? 'isDisable' : '' }}" href="{{ url('xem-chapter/'.$truyen->Truyen1->slug_truyen.'/'.$prev_chapter) }}">Tập trước</a></p>
                <select name="kichhoat" class="form-select" id="select-chapter">
                    @foreach ($tatcatruyen as $item)
                        <option {{ $chapter->ID === $item->ID ? 'selected' : false }} value="{{ url('xem-chapter/'.$item->slug_chapter) }}">{{ $item->tieude }}</option>
                    @endforeach
                </select>
                
                <p class="mt-3"><a class="btn btn-primary {{ $chapter->ID === $max_id->ID ? 'isDisable' : '' }}" href="{{ url('xem-chapter/'.$truyen->Truyen1->slug_truyen.'/'.$next_chapter) }}">Tập sau</a></p>
            </div>
        </div>
        <div class="col-md-12"></div>
            <div class="noidungchuong">
                <p>{!! $chapter->noidung !!}</p>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection