<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Barang;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\DataTables\Datatables;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json(){
        $shop = Penjualan::all();
        // $suplier = $shop->Barang1->nama;
        // dd($suplier);
        return Datatables::of($shop)
        ->addColumn('nama_bar',function($shop){
                return $shop->Barang1['nama'];
            })

        ->addColumn('hehe', function ($shop) {
                return number_format($shop->total_bayar,2,',','.');
            })

        ->addColumn('action',function($shop){
                return '<center><a href="#" class="btn btn-xs btn-primary edit" data-id="'.$shop->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> | <a href="#" class="btn btn-xs btn-danger delete" id="'.$shop->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a></center>';
            })
        ->rawColumns(['nama_bar','hehe','action'])->make(true);
    }

    public function index()
    {
        $barang = Barang::all();
        return view('shop.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'kode_penjualan' => 'required',
            'tgl_jual'=>'required',
            'nama_pelanggan'=>'required',
            'id_barang'=>'required',
            'jumlah'=>'required'
            ],[
            'kode_penjualan.required'=>'Kode Penjualan tidak boleh kosong',
            'tgl_jual.required'=>'Tanggal Jual tidak boleh kosong',
            'nama_pelanggan.required'=>'Nama Pelanggan tidak boleh kosong',
            'id_barang.required'=>'Barang tidak boleh kosong',
            'jumlah.required'=>'Jumlah tidak boleh kosong'
            ]);

            $data = new Penjualan;
            $data->kode_penjualan = $request->kode_penjualan;
            $data->tgl_jual = $request->tgl_jual;
            $data->nama_pelanggan = $request->nama_pelanggan;
            $data->id_barang = $request->id_barang;
            $data->jumlah = $request->jumlah;
            $jumlah = $request->jumlah;
            $barang = Barang::where('id',$request->id_barang)->first();
            $data->total_bayar = $jumlah * $barang->harga_satuan;
            $data->save();

            $barang->stok = $barang->stok - $jumlah;
            $barang->save();
            return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Penjualan::findOrFail($id);
        return $shop;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_penjualan' => 'required',
            'tgl_jual'=>'required',
            'nama_pelanggan'=>'required',
            'id_barang'=>'required',
            'jumlah'=>'required'
            ],[
            'kode_penjualan.required'=>'Kode Penjualan tidak boleh kosong',
            'tgl_jual.required'=>'Tanggal Jual tidak boleh kosong',
            'nama_pelanggan.required'=>'Nama Pelanggan tidak boleh kosong',
            'id_barang.required'=>'Barang tidak boleh kosong',
            'jumlah.required'=>'Jumlah tidak boleh kosong'
            ]);

            $data = Penjualan::find($id);
            $data->kode_penjualan = $request->kode_penjualan;
            $data->tgl_jual = $request->tgl_jual;
            $data->nama_pelanggan = $request->nama_pelanggan;
            $data->id_barang = $request->id_barang;
            $data->jumlah = $request->jumlah;
            $jumlah = $request->jumlah;
            $barang = Barang::where('id',$data->id_barang)->first();
            $data->total_bayar = $jumlah * $barang->harga_satuan;
            $data->save();
            return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }

    public function removedata(Request $request)
    {
        $shop = Penjualan::find($request->input('id'));
        if($shop->delete())
        {
            echo 'Data Deleted';
        }
    }
}
