<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori','parent_id'];
    public $timestamp = true;

    public function Barangkategori(){
    	return $this->hasMany('App\Barang','kat_id');
    }
    public function Penjualankategori(){
    	return $this->hasOne('App\Penjualan','kat_id');
    }
    public function subkat(){
        return $this->hasOne('App\Penjualan','sub_id');
    }
    public function Subkategori(){
        return $this->hasMany('App\Barang','id_parent');
    }
    public function parent(){
    	return $this->belongsTo('App\Kategori','parent_id');
    }
    public function turunan(){
    	return $this->hasMany('App\Kategori','parent_id');
    }
}
