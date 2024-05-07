<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;


class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $chapter = Chapter::with('Truyen1')->orderBy('ID', 'DESC')->get();
        $chapter = Chapter::select('chapter.*', 'truyen.tentruyen')
        ->join('truyen', 'truyen.ID', '=', 'chapter.truyen_id')
        ->get();
        // dd($chapter);
        return view("admincp.chapter.lietke")->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $truyen = Truyen::orderBy('ID', 'ASC')->get();
        return view("admincp.chapter.them")->with(compact('truyen'));
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
            'tieude' => 'required|unique:chapter|max:255',
            'slug_chapter' => 'required|unique:chapter|max:255',
            'tomtat' => 'required',
            'trangthai' => 'required',
            'noidung' => 'required',
            'thuoctruyen' => 'required'
        ], [
            'tieude.required' => 'Ten tieu de la bat buoc',
            'slug_chapter.required' => 'Slug danh muc la bat buoc',
            'tieude.max' => 'Khong duoc qua 255 ki tu',
            'tomtat.required' => 'Mo ta la bat buoc',
            'noidung.required' => 'Noi dung phai co'
        ]);

        $saveData = new Chapter();
        $saveData->truyen_id = $data['thuoctruyen'];
        $saveData->slug_chapter = $data['slug_chapter'];
        $saveData->tomtat = $data['tomtat'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->tieude = $data['tieude'];
        $saveData->noidung = $data['noidung'];
        
        $saveData->save();
        return back()->with('msg', 'Thêm chapter thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('ID', 'ASC')->get();
        return view("admincp.chapter.sua")->with(compact('truyen','chapter'));
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
            'tieude' => 'required|max:255',
            'slug_chapter' => 'required|max:255',
            'tomtat' => 'required',
            'trangthai' => 'required',
            'noidung' => 'required',
            'thuoctruyen' => 'required'
        ], [
            'tieude.required' => 'Ten tieu de la bat buoc',
            'slug_chapter.required' => 'Slug danh muc la bat buoc',
            'tieude.max' => 'Khong duoc qua 255 ki tu',
            'tomtat.required' => 'Mo ta la bat buoc',
            'noidung.required' => 'Noi dung phai co'
        ]);

        $saveData = Chapter::find($id);
        $saveData->truyen_id = $data['thuoctruyen'];
        $saveData->slug_chapter = $data['slug_chapter'];
        $saveData->tomtat = $data['tomtat'];
        $saveData->trangthai = $data['trangthai'];
        $saveData->tieude = $data['tieude'];
        $saveData->noidung = $data['noidung'];
        
        $saveData->save();
        return back()->with('msg', 'Sửa chapter thành công');
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
