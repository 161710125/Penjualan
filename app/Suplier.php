<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $fillable=array('nama','asal_kota');
    public 	  $timestamp = true;

    public function Barang(){
    	return $this->hasMany('App\Barang','id_suplier');
    }
}
