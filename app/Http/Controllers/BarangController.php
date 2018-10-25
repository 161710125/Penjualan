<?php
namespace App\Http\Controllers;
use App\Barang;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\DataTables\Datatables;
use App\Suplier;
use App\Kategori;
use DB;
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
        ->addColumn('kategori', function($bar){
            return $bar->kategoribarang->nama_kategori;
        })
        ->addColumn('parent', function($bar){
            return $bar->subbarang->nama_kategori;
        })
        ->addColumn('nama_sup',function($bar){
                return $bar->Suplier['nama'];
            })
        ->addColumn('formatharga', function($bar){
            return number_format($bar->harga_satuan,2,',','.');
        })

        ->addColumn('action',function($bar){
                return '<center><a href="#" class="btn btn-xs btn-primary edit" data-id="'.$bar->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> | <a href="#" class="btn btn-xs btn-danger delete" id="'.$bar->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a></center>';
            })
        ->rawColumns(['nama_sup','action','formatharga','kategori','parent'])->make(true);
    }
    public function index()
    {
        $suplier = Suplier::all();
        $barangkategori = Kategori::where('parent_id','=',null)->get();
        return view('barang.index', compact('suplier','barangkategori'));
    }

    public function myformAjax($id)
    {
        $sub = DB::table("kategoris")
                    ->join('barangs','kategoris.id','=','barangs.id_parent')
                    ->where("kategoris.parent_id",$id)
                    ->pluck("kategoris.nama_kategori","kategoris.id");
        return json_encode($sub);
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
            'id_suplier' => 'required',
            'kat_id' => 'required',
            'id_parent' => 'required',
            'merk'=>'required',
            'harga_satuan'=>'required',
            'stok'=>'required'
            ],[
            'id_suplier.required' => 'suplier Tidak Boleh Kosong',
            'kat_id.required' => 'Kategori tidak boleh Kosong',
            'id_parent.required' => 'Nama Barang Harus Diisi',
            'merk.required'=>'Merk tidak boleh kosong',
            'harga_satuan.required'=>'Harga Satuan tidak boleh kosong',
            'stok.required'=>'Stok tidak boleh kosong'
            ]);
            $data = new Barang;
            $data->id_suplier = $request->id_suplier;
            $data->kat_id = $request->kat_id;
            $data->id_parent = $request->id_parent;
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
    public function edit($id)
    {
        $bar = Barang::findOrFail($id);
        $kategori = Kategori::where('parent_id', $bar->kat_id)->get();
        $sub = '';
        foreach ($kategori as $key => $value) {
            if ($value->id == $bar->id_parent) {
                $selected = 'selected';
            }else{
                $selected = '';
            }
            $sub .= '<option value="'.$value->id.'">' .$value->nama_kategori. '</option>';
        }
        $data ['bar']=$bar;
        $data ['sub']=$sub;
        return $data;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_suplier'=>'required',
            'kat_id' => 'required',
            'id_parent' => 'required',
            'merk'=>'required',
            'harga_satuan'=>'required',
            'stok'=>'required'
            ],[
            'id_suplier.required' => 'id_suplier Tidak Boleh Kosong',
            'kat_id.required' => 'Harus Diisi',
            'id_parent.required' => 'Harus Diisi',
            'merk.required'=>'Merk tidak boleh kosong',
            'harga_satuan.required'=>'Harga Satuan tidak boleh kosong',
            'stok.required'=>'Stok tidak boleh kosong'
            ]);
            $data = Barang::findOrFail($id);
            $data->id_suplier = $request->id_suplier;
            $data->kat_id = $request->kat_id;
            $data->id_parent = $request->id_parent;
            $data->merk = $request->merk;
            $data->harga_satuan = $request->harga_satuan;
            $data->stok = $request->stok;
            $data->save();
            return response()->json(['success'=>true]);
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

    public function removedata(Request $request)
    {
        $sis = Barang::find($request->input('id'));
        if($sis->delete())
        {
            echo 'Data Deleted';
        }
    }
}