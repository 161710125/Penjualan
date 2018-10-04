<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Suplier;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json(){
        $bar = Barang::all();
        // $suplier = $bar->Suplier1->nama;
        // dd($suplier);
        return Datatables::of($bar)
        ->addColumn('nama_sup',function($bar){
                return $bar->Suplier->nama;
            })

        ->addColumn('action',function($bar){
                return '<center><a href="#" class="btn btn-xs btn-primary edit" data-id="'.$bar->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> | <a href="#" class="btn btn-xs btn-danger delete" id="'.$bar->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a></center>';
            })

        ->rawColumns(['nama_sup','action'])->make(true);
    }

    public function index()
    {
        $suplier = Suplier::all();
        return view('barang.index',compact('suplier'));
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'merk'=>'required',
            'harga_satuan'=>'required',
            'stok'=>'required'
            ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'merk.required'=>'Asal Kota tidak boleh kosong',
            'harga_satuan.required'=>'Asal Kota tidak boleh kosong',
            'stok.required'=>'Asal Kota tidak boleh kosong'
            ]);

            $data = new Barang;
            $data->id_suplier = $request->id_suplier;
            $data->nama = $request->nama;
            $data->merk = $request->merk;
            $data->harga_satuan = $request->harga_satuan;
            $data->stok = $request->stok;
            $data->save();
            return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
