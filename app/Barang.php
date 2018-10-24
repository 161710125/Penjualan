<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable=array('id_suplier','kat_id','id_parent','merk','harga_satuan','stok');
    public 	  $timestamp = true;

    public function Suplier(){
       return $this->belongsTo('App\Suplier', 'id_suplier');
    } 

    public function Penjualan(){
    	return $this->hasOne('App\Penjualan', 'id_barang');
    }
    public function kategoribarang(){
    	return $this->belongsTo('App\Kategori', 'kat_id');
    }
    public function subbarang(){
        return $this->belongsTo('App\Kategori', 'id_parent');
    }
}
