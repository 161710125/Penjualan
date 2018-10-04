<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable=array('kode_penjualan','tgl_jual','nama_pelanggan','id_barang','jumlah','total_bayar');
    public 	  $timestamp = true;

    public function Barang1(){
       return $this->belongsTo('App\Barang', 'id_barang');
    }
}