<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use Carbon\Carbon;

class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sach = Sach::orderBy('ID', 'ASC')->get();
        return view("admincp.sach.lietke")->with(compact('sach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admincp.sach.them");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'tensach' => 'required|unique:sach|max:255',
            'slug_sach' => 'required|unique:sach|max:255',
            'tentacgia' => 'required',
            'tomtat' => 'required',
            'trangthai' => 'required',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'tukhoa' => 'required'
        ], [
            'tensach.required' => 'Ten danh muc la bat buoc',
            'slug_sach.required' => 'Slug danh muc la bat buoc',
            'tensach.max' => 'Khong duoc qua 255 ki tu',
            'tomtat.required' => 'Mo ta la bat buoc',
            'hinhanh.required' => 'Hinh anh phai co',
            'tentacgia.required' => 'Required tac gia',
            'tukhoa.required' => 'Required tu khoa'
        ]);

        $saveData = new Sach();
        $saveData->tensach = $data['tensach'];
        $saveData->slug_sach = $data['slug_sach'];
        $saveData->tukhoa = $data['tukhoa'];
        $saveData->mota = $data['tomtat'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->tacgia = $data['tentacgia'];
        // $saveData->loaitruyen = $data['loaitruyen'];

        $saveData->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        

        // foreach($data['danhmuctruyen'] as $item) {
        //     $saveData->danhmuc_id = $item[0];
        // }

        // foreach($data['theloai'] as $item) {
        //     $saveData->theloai_id = $item[0];
        // }


        $get_image = $request->hinhanh;
        $path = "Assets/image/HinhAnhSach/";
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.time().'.'.$get_image->getClientOriginalName();
        $get_image->move($path, $new_image);
        $saveData->hinhanh = $new_image;
        $saveData->save();

        // $saveData->thuocnhieudanhmuctruyen()->attach($data['danhmuctruyen']);
        // $saveData->thuocnhieutheloaitruyen()->attach($data['theloai']);

        return back()->with('msg', 'Thêm sách thành công');
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
        $sach = Sach::find($id);
        $path = "Assets/image/HinhAnhTruyen/".$sach->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        Sach::find($id)->delete();
        return back()->with('status', 'Xóa thành công');
    }
}
