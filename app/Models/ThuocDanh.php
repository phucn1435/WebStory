<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocDanh extends Model
{
    use HasFactory;

    
    protected $fillTable = ['truyen_id', 'danhmuc_id'];

    protected $primaryKey = 'ID';
    protected $table = 'thuocdanh';

    // public function truyen() {
    //     return $this->belongsTo('App\Models\Truyen','theloai_id','ID');
    // }

}
