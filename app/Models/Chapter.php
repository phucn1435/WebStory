<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillTable = ['truyen_id', 'tomtat', 'tieude', 'noidung', 'trangthai', 'slug_chapter'];

    protected $primaryKey = 'ID';
    protected $table = 'chapter';
    
    public function Truyen1() {
        return $this->belongsTo('App\Models\Truyen', 'truyen_id','ID');
    }
}
