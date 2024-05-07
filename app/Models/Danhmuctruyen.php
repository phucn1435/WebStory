<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Danhmuctruyen extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillTable = ['tendanhmuc', 'slug_danhmuc', 'mota', 'trangthai'];

    protected $primaryKey = 'ID';
    protected $table = 'danhmuc';
    
    // public function truyen() {
    //     return $this->hasMany('App\Models\Truyen');
    // }
}
