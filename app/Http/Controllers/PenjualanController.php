<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Barang;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Kategori;

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
        ->addColumn('jual', function($shop){
            return $shop->Barang1['merk'];
        })
        ->addColumn('kategori', function($shop){
            return $shop->barangkategori['nama_kategori'];
        }) 
        ->addColumn('subbar', function($shop){
            return $shop->sub['nama_kategori'];
        })
        ->addColumn('hehe', function ($shop) {
                return number_format($shop->total_bayar,2,',','.');
            })

        ->addColumn('action',function($shop){
                return '<center><a href="#" class="btn btn-xs btn-primary edit" data-id="'.$shop->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> | <a href="#" class="btn btn-xs btn-danger delete" id="'.$shop->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a></center>';
            })
        ->rawColumns(['jual','kategori','subbar','hehe','action'])->make(true);
    }

    public function index()
    {
        $barang = Barang::all();
        $barkategori = Kategori::where('parent_id','=',null)->get();
        return view('shop.index', compact('barang','barkategori'));
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
        $barang = Barang::where('id', $request->id_barang)->first();
        $stok = $barang->stok;
        $this->validate($request, [
            'kode_penjualan' => 'required',
            'tgl_jual'=>'required',
            'nama_pelanggan'=>'required',
            'id_barang'=>'required',
            'kat_id' => 'required',
            'sub_id' => 'required',
            'jumlah'=>"required|numeric|min:1|max:$stok"
            ],[
            'kode_penjualan.required'=>'Kode Penjualan tidak boleh kosong',
            'tgl_jual.required'=>'Tanggal Jual tidak boleh kosong',
            'nama_pelanggan.required'=>'Nama Pelanggan tidak boleh kosong',
            'id_barang.required'=>'Barang tidak boleh kosong',
            'jumlah.required'=>'Jumlah tidak boleh kosong',
            'kat_id.required' => 'Harus Diisi',
            'sub_id.required' => 'Harus Diisi',
            'jumlah.max' => 'tidak boleh melebihi stok, Stok Barang Saat Ini = '.$stok,
            'jumlah.min' => 'tidak boleh kurang dari 1',
            ]);

            $data = new Penjualan;
            $data->kode_penjualan = $request->kode_penjualan;
            $data->tgl_jual = $request->tgl_jual;
            $data->nama_pelanggan = $request->nama_pelanggan;
            $data->id_barang = $request->id_barang;
            $data->kat_id = $request->kat_id;
            $data->sub_id = $request->sub_id;
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
            'jumlah'=>'required|numeric|not_in:0'
            ],[
            'kode_penjualan.required'=>'Kode Penjualan tidak boleh kosong',
            'tgl_jual.required'=>'Tanggal Jual tidak boleh kosong',
            'id_barang.required'=>'Barang tidak boleh kosong',
            'jumlah.required'=>'Jumlah tidak boleh kosong',
            'jumlah.numeric' => 'inputan Harus berupa angka',
            'jumlah.not_in' => 'tidak bisa menginput'
            ]);

            $data = Penjualan::find($id);
            $data->kode_penjualan = $request->kode_penjualan;
            $data->tgl_jual = $request->tgl_jual;
            $data->nama_pelanggan = $request->nama_pelanggan;
            $data->id_barang = $request->id_barang;
            $data->jumlah = $request->jumlah;
            $data->kat_id = $request->kat_id;
            $data->sub_id = $request->sub_id;

            $baru = Barang::find($id);
        if ($request->jumlah <= $baru->stok) {
            $anyar = Penjualan::find($id);
            $anyar->jumlah = $anyar->jumlah - $request->jumlah;

            $new = Barang::where('id', $data->id_barang)->first();
            $new->stok = $new->stok + $anyar->jumlah;
            $anyar->save();
            $new->save();
            $data->jumlah = $request->jumlah;

            $data->total_bayar = $data->jumlah*$baru->harga_satuan;
            $data->save();
            return response()->json(['success'=>true,'message'=>'berhasil update']);
        }
        elseif ($request->jumlah > $baru->stok)  {

            $barangstok = Barang::where('id', $data->id_barang)->first();
            $barangstok->stok = ($barangstok->stok + $data->jumlah) - $request->jumlah;
            $barangstok->save();
            $data->jumlah = $request->jumlah;

            $coba = Penjualan::find($id);
            $coba->jumlah = $coba->jumlah - $request->jumlah;
            $coba->save();

            $data->total_bayar = $data->jumlah*$baru->harga_satuan;
            $data->save();

            return response()->json(['success'=>true,'message'=>'terpenuhi']);
        }
        return response()->json(['error'=>true, 'pesan'=>'tidak terpenuhi']);
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
