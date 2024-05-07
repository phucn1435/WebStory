<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Danhmuctruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\TheLoai;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;
use Carbon\Carbon;


class IndexController extends Controller
{
    //
    public function home() {
        $theloai = TheLoai::orderBy('ID', 'ASC')->get();
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $truyen = Truyen::orderBy('ID', 'DESC')->where('trangthai', 0)->get();
        // dd($truyen);
        return view("pages.home")->with(compact('danhmuc','truyen','theloai'));
    }

    public function timkiem(Request $request) {
        $data = $request->all();
        
        $keyword = $data['tukhoa'];
        $theloai = TheLoai::orderBy('ID', 'ASC')->get();
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $truyen = Truyen::orderBy('ID', 'DESC')->where('tentruyen','LIKE','%'.$keyword.'%')->get();
        return view("pages.timkiem")->with(compact('danhmuc','truyen','theloai'));
    }

    public function timkiem_ajax(Request $request) {
        $data = $request->all();
        
        if($data['keywords']) {
            $truyen = Truyen::where('trangthai', 0)->where('tentruyen', 'LIKE', '%'.$data['keywords'].'%')->get();

            $output = '
                <ul class="dropdown-menu" style="display: block;">';

            foreach($truyen as $item) {
                $output .= '<li class="li_search_ajax"><a href="#">'.$item->tentruyen.'</a></li>';
            }

            $output .= '</ul>';
            echo $output;
        }
    }

    public function doctruyen($slug, REQUEST $request) {
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $truyen = Truyen::with('chapter','danhmuctruyen', 'theloai', 'thuocnhieutheloaitruyen','thuocnhieudanhmuctruyen')->where('trangthai', 0)->where('slug_truyen', $slug)->first();
        // dd($truyen);
        $truyen->luotxem++;
        $truyen->save();
        $truyen_moi = Truyen::where('loaitruyen', 0)->orderBy('ID', 'DESC')->get();
        $truyen_noibat = Truyen::where('loaitruyen', 1)->orderBy('ID', 'DESC')->get();
        $truyen_hot = Truyen::where('loaitruyen', 2)->orderBy('ID', 'DESC')->get();

        $theloai = TheLoai::orderBy('ID', 'ASC')->get();
        
        $chapter = Chapter::with('Truyen1')->orderBy('ID', 'ASC')->where('truyen_id',$truyen->ID)->get();
        
        $cungdanhmuc = Truyen::with('danhmuctruyen')
        ->where('danhmuc_id', $truyen->danhmuctruyen->ID)
        ->whereNotIn('ID', [$truyen->ID])
        ->get();

        $chuong_moinhat = Chapter::where('truyen_id', $truyen->ID)->orderBy('ID', 'DESC')->first();

        // dd($chuong_moinhat);
        $chapter_dau = Chapter::with('Truyen1')->orderBy('ID','ASC')->where('truyen_id', $truyen->ID)->first();

        return view('pages.truyen')->with(compact('truyen','danhmuc', 'chapter', 'cungdanhmuc','chapter_dau','theloai','chuong_moinhat','truyen_moi','truyen_noibat','truyen_hot'));
    }

    public function danhmuc($slug) {
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $danhmuc_id = Danhmuctruyen::where('slug_danhmuc', $slug)->first();
        $theloai = TheLoai::orderBy('ID', 'ASC')->get();
        $truyen = Truyen::orderBy('ID', 'DESC')->where('trangthai', 0)->where('danhmuc_id', $danhmuc_id->ID)->get();
        
        return view("pages.danhmuc")->with(compact('danhmuc','truyen','theloai'));
    } 

    public function theloai($slug) {
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $theloai = TheLoai::orderBy('ID', 'ASC')->get();
        $theloai_cuthe = TheLoai::where('slug_theloai', $slug)->first();
        $truyen_theloai = Truyen::with('theloai')->where('theloai_id', $theloai_cuthe->ID)->get();
        return view('pages.theloai')->with(compact('danhmuc','theloai','theloai_cuthe','truyen_theloai'));
    }
    public function xemchapter($slug, $slug_chapter) {
       
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $truyen = Chapter::with('Truyen1')->where('slug_chapter', $slug_chapter)->first();
        // dd($truyen);
        $chapter = Chapter::with('Truyen1')
        ->where('slug_chapter', $slug_chapter)
        ->where('truyen_id', $truyen->Truyen1->ID)
        ->first();

        
        // dd($chapter->ID);
        // dd($truyen->truyen_id);
        // $theloai = Truyen::where('ID', $chapter->truyen_id)->first();
        $theloai = TheLoai::orderBy('ID', 'ASC')->get();

        $tatcatruyen = Chapter::with('Truyen1')
        ->orderBy('ID','ASC')
        // ->where('slug_chapter', $slug_chapter)
        ->where('truyen_id', $truyen->truyen_id)
        ->get();

        $max_id = Chapter::where('truyen_id', $truyen->truyen_id)->orderBy('ID', 'DESC')->first();
        $min_id = Chapter::where('truyen_id', $truyen->truyen_id)->orderBy('ID', 'ASC')->first();
       
        $next_chapter = Chapter::with('Truyen1')->where('truyen_id', $truyen->truyen_id)->where('ID', '>', $chapter->ID)->min('slug_chapter');
        $prev_chapter = Chapter::where('truyen_id', $truyen->truyen_id)->where('ID', '<', $chapter->ID)->max('slug_chapter');

        $arr = [];
        $arr[] = $next_chapter;
        $arr[] = $prev_chapter;

        return view("pages.chapter")->with(compact('truyen','danhmuc','chapter','theloai', 'tatcatruyen','next_chapter','prev_chapter','max_id','min_id'));
    }

    public function tag($tag) {
        $danhmuc = Danhmuctruyen::orderBy('ID', 'ASC')->get();
        $theloai = TheLoai::orderBy('ID', 'ASC')->get();
        $tags = explode("-", $tag);
        $truyen = Truyen::with('thuocnhieutheloaitruyen','thuocnhieudanhmuctruyen')
        ->where(function($query) use ($tags) {
            for ($i = 0; $i < count($tags); $i++) {
                $query->orWhere('tukhoa','LIKE', '%' . $tags[$i] . '%');
            }
        })
        ->paginate(12);

        // dd($truyen);
        return view('pages.tag')->with(compact('truyen','danhmuc','theloai'));
    }

    public function topPanel(REQUEST $request){
        $data = $request->all();
        // echo $data['danhmuc_id'];
        $truyen = Truyen::where('danhmuc_id', $data['danhmuc_id'])->orderBy('ID', 'ASC')->get();
        $output = "<div class='row'>";
        foreach($truyen as $item){
            $output .= '
            <div class="col-md-3">
              <div class="card mb-3 box-shadow">
                <img class="card-img-top" src="'.asset('Assets/image/HinhAnhTruyen/'.$item->hinhanh).'" >
                <div class="card-body">
                  <h5>'.$item->tentruyen.'</h5>
                  <p class="card-text">'.$item->mota.'</p> 
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="xem-truyen/'.$item->slug_truyen.'"  type="button" class="btn btn-sm btn-danger">Đọc ngay</a>
                      <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>515151</button>
                    </div>
                    <small class="text-muted">9 mins ago</small>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
        $output .= '</div>';
        echo $output;
    }   


}
