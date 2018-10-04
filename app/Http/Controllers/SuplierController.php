<?php

namespace App\Http\Controllers;

use App\Suplier;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\DataTables\Datatables;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json(){
        $sis = Suplier::all();
        return Datatables::of($sis)
        ->addColumn('action',function($sis){
                return '<center><a href="#" class="btn btn-xs btn-primary edit" data-id="'.$sis->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> | <a href="#" class="btn btn-xs btn-danger delete" id="'.$sis->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a></center>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        return view('sup.index');
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
            'asal_kota'=>'required'
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'asal_kota.required'=>'Asal Kota tidak boleh kosong'
    ]);
            $data = new Suplier;
            $data->nama = $request->nama;
            $data->asal_kota = $request->asal_kota;
            $data->save();
            return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suplier $suplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sup = Suplier::findOrFail($id);
        return $sup;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'asal_kota'=>'required'
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'asal_kota.required'=>'Asal Kota tidak boleh kosong'
    ]);
            $data = Suplier::find($id);
            $data->nama = $request->nama;
            $data->asal_kota = $request->asal_kota;
            $data->save();
            return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suplier $suplier)
    {
        //
    }

    public function removedata(Request $request)
    {
        $sis = Suplier::find($request->input('id'));
        if($sis->delete())
        {
            echo 'Data Deleted';
        }
    }
}
