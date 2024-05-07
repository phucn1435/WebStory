<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucTruyen;

class DanhMucTruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $danhmuctruyen = DanhMucTruyen::orderBy('ID', 'ASC')->get();
        return view("admincp.danhmuc.lietke")->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admincp.danhmuc.them");
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
            'tendanhmuc' => 'required|unique:danhmuc|max:255',
            'slug_danhmuc' => 'required|unique:danhmuc|max:255',
            'mota' => 'required|max:255',
            'trangthai' => 'required'
        ], [    
            'tendanhmuc.required' => 'Ten danh muc la bat buoc',
            'slug_danhmuc.required' => 'Slug danh muc la bat buoc',
            'tendanhmuc.max' => 'Khong duoc qua 255 ki tu',
            'mota.required' => 'Mo ta la bat buoc',
            'mota.max' => 'Khong duoc qua 255 ki tu'
        ]);

        $saveData = new DanhMucTruyen();
        $saveData->tendanhmuc = $data['tendanhmuc'];
        $saveData->slug_danhmuc = $data['slug_danhmuc'];
        $saveData->mota = $data['mota'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->save();
        return back()->with('msg', 'Thêm danh mục thành công');
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
        $dataEdit = DanhMucTruyen::find($id); 
        return view("admincp.danhmuc.sua")->with(compact('dataEdit'));
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
            'tendanhmuc' => 'required|max:255',
            'slug_danhmuc' => 'required|max:255',
            'mota' => 'required|max:255',
            'trangthai' => 'required'
        ], [    
            'tendanhmuc.required' => 'Ten danh muc la bat buoc',
            'slug_danhmuc.required' => 'Ten danh muc la bat buoc',
            'tendanhmuc.max' => 'Khong duoc qua 255 ki tu',
            'mota.required' => 'Mo ta la bat buoc',
            'mota.max' => 'Khong duoc qua 255 ki tu'
        ]);
        $dataEdit = DanhMucTruyen::find($id);

        $dataEdit->tendanhmuc = $data['tendanhmuc'];
        $dataEdit->slug_danhmuc = $data['slug_danhmuc'];
        $dataEdit->mota = $data['mota'];
        $dataEdit->trangthai = $data['trangthai'];
        $dataEdit->save();

        return back()->with('status', 'Cập nhật danh mục thành công');
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
        DanhMucTruyen::find($id)->delete();
        return back()->with('status', 'Xóa thành công');
    }
}
