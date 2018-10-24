<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable=array('kode_penjualan','tgl_jual','nama_pelanggan','id_barang','jumlah','kat_id','sub_id','total_bayar');
    public 	  $timestamp = true;
 
    public function Barang1(){
       return $this->belongsTo('App\Barang', 'id_barang');
    }
    public function barangkategori(){
    	return $this->belongsTo('App\Kategori','kat_id');
    }
    public function sub(){
    	return $this->belongsTo('App\Kategori','sub_id');
    }
}