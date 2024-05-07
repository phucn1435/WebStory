<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucTruyen;
use App\Models\Truyen;
use App\Models\TheLoai;
use Carbon\Carbon;


class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with('danhmuctruyen','theloai','thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('ID', 'ASC')->get();
        $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('ID', 'ASC')->get();

        return view("admincp.truyen.lietke")->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $danhmuctruyen = DanhMucTruyen::orderBy('ID', 'ASC')->get();
        $theloaitruyen = TheLoai::orderBy('ID', 'ASC')->get();

        return view("admincp.truyen.them")->with(compact('danhmuctruyen','theloaitruyen'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tentruyen' => 'required|unique:truyen|max:255',
            'slug_truyen' => 'required|unique:truyen|max:255',
            'tentacgia' => 'required',
            'tomtat' => 'required',
            'trangthai' => 'required',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'danhmuctruyen' => 'required',
            'theloai' => 'required',
            'tukhoa' => 'required',
            'loaitruyen'=> 'required'
        ], [
            'tentruyen.required' => 'Ten danh muc la bat buoc',
            'slug_truyen.required' => 'Slug danh muc la bat buoc',
            'tentruyen.max' => 'Khong duoc qua 255 ki tu',
            'tomtat.required' => 'Mo ta la bat buoc',
            'hinhanh.required' => 'Hinh anh phai co',
            'theloai.required' => 'Required the loai',
            'tentacgia.required' => 'Required tac gia',
            'tukhoa.required' => 'Required tu khoa',
            'loaitruyen.required' => 'required loai truyen'
        ]);

        $saveData = new Truyen();
        $saveData->tentruyen = $data['tentruyen'];
        $saveData->slug_truyen = $data['slug_truyen'];
        $saveData->tukhoa = $data['tukhoa'];
        $saveData->mota = $data['tomtat'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->tacgia = $data['tentacgia'];
        $saveData->loaitruyen = $data['loaitruyen'];
        $saveData->luotxem = 0; 

        $saveData->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        

        foreach($data['danhmuctruyen'] as $item) {
            $saveData->danhmuc_id = $item[0];
        }

        foreach($data['theloai'] as $item) {
            $saveData->theloai_id = $item[0];
        }


        $get_image = $request->hinhanh;
        $path = "Assets/image/HinhAnhTruyen/";
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.time().'.'.$get_image->getClientOriginalName();
        $get_image->move($path, $new_image);
        $saveData->hinhanh = $new_image;
        $saveData->save();

        $saveData->thuocnhieudanhmuctruyen()->attach($data['danhmuctruyen']);
        $saveData->thuocnhieutheloaitruyen()->attach($data['theloai']);

        return back()->with('msg', 'Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $danhmuctruyen = DanhMucTruyen::orderBy('ID', 'ASC')->get();
        $dataEdit = Truyen::find($id); 
        return view("admincp.truyen.sua")->with(compact('dataEdit', 'danhmuctruyen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate([
            'tentruyen' => 'required|max:255',
            'slug_truyen' => 'required|max:255',
            'tomtat' => 'required',
            'trangthai' => 'required',
            // 'hinhanh' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'danhmuctruyen' => 'required'
        ], [    
            'tentruyen.required' => 'Ten danh muc la bat buoc',
            'slug_truyen.required' => 'Slug danh muc la bat buoc',
            'tentruyen.max' => 'Khong duoc qua 255 ki tu',
            'tomtat.required' => 'Mo ta la bat buoc',
            'hinhanh.required' => 'Hinh anh phai co'
        ]);

        $saveData = Truyen::find($id);
        $saveData->tentruyen = $data['tentruyen'];
        $saveData->slug_truyen = $data['slug_truyen'];
        $saveData->mota = $data['tomtat'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->danhmuc_id = $data['danhmuctruyen'];

        $saveData->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        
        $get_image = $request->hinhanh;
        if ($get_image) {
            $path = "Assets/image/HinhAnhTruyen/".$saveData->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = "Assets/image/HinhAnhTruyen/";
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.time().'.'.$get_image->getClientOriginalName();
            $get_image->move($path, $new_image);
            $saveData->hinhanh = $new_image;
        }
        $saveData->save();
        return back()->with('msg', 'Sửa truyện thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $truyen = Truyen::find($id);
        $path = "Assets/image/HinhAnhTruyen/".$truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        Truyen::find($id)->delete();
        return back()->with('status', 'Xóa thành công');
    }

    public function loaitruyen(REQUEST $request) {
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->loaitruyen = $data['loaitruyen'];
        $truyen->save();
    }
}
