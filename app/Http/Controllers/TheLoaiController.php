<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\Truyen;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $list_truyen = TheLoai::orderBy('ID', 'ASC')->get();
        $list_truyen = TheLoai::orderBy('ID', 'ASC')->get();
        // dd($list_truyen);
        return view("admincp.theloai.lietke")->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admincp.theloai.them');
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
            'tentheloai' => 'required|unique:theloai|max:255',
            'slug_theloai' => 'required|unique:theloai|max:255',
            'mota' => 'required|max:255',
            'trangthai' => 'required'
        ], [    
            'tendanhmuc.required' => 'Ten theloai la bat buoc',
            'slug_danhmuc.required' => 'Slug theloai la bat buoc',
            'tendanhmuc.max' => 'Khong duoc qua 255 ki tu',
            'mota.required' => 'Mo ta la bat buoc',
            'mota.max' => 'Khong duoc qua 255 ki tu'
        ]);

        $saveData = new Theloai();
        $saveData->tentheloai = $data['tentheloai'];
        $saveData->slug_theloai = $data['slug_theloai'];
        $saveData->mota = $data['mota'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->save();
        return back()->with('msg', 'Thêm thể loại thành công');
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
    }
}
