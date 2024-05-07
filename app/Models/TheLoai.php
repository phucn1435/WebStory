<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillTable = ['tentheloai', 'slug_theloai', 'mota', 'trangthai'];

    protected $primaryKey = 'ID';
    protected $table = 'theloai';

    public function truyen() {
        return $this->belongsTo('App\Models\Truyen','theloai_id','ID');
    }

}
