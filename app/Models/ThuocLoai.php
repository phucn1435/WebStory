<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocLoai extends Model
{
    use HasFactory;
    
    protected $fillTable = ['truyen_id', 'theloai_id'];

    protected $primaryKey = 'ID';
    protected $table = 'thuocloai';

    // public function truyen() {
    //     return $this->belongsTo('App\Models\Truyen','theloai_id','ID');
    // }

}
