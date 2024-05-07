<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = false;
    protected $fillTable = ['tentruyen', 'mota','tukhoa','danhmuc_id', 'theloai_id', 'hinhanh', 'slug_truyen', 'trangthai', 'tacgia','luotxem','created_at','updated_at'];

    protected $primaryKey = 'ID';
    protected $table = 'truyen';

    public function danhmuctruyen() {
        return $this->belongsTo('App\Models\Danhmuctruyen','danhmuc_id','ID');
    }

    public function chapter() {
        return $this->hasMany('App\Models\Chapter','truyen_id','ID');
    }

    public function theloai() {
        return $this->belongsTo('App\Models\TheLoai','theloai_id', 'ID');
    }
    
    /**
     * The roles that belong to the Truyen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function thuocnhieudanhmuctruyen()
    {
        return $this->belongsToMany(Danhmuctruyen::class, 'thuocdanh', 'truyen_id', 'danhmuc_id');
    }

    public function thuocnhieutheloaitruyen()
    {
        return $this->belongsToMany(TheLoai::class, 'thuocloai', 'truyen_id', 'theloai_id');
    }
}
