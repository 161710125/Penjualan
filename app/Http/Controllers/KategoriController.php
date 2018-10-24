<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\DataTables\Datatables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json()
    {
        $kategori = Kategori::all();
        return Datatables::of($kategori)
        ->addColumn('action', function($kategori){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$kategori->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$kategori->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        $kategori = Kategori::where('parent_id','=',null)->get();
        return view('kategori.index', compact('kategori'));
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
            'nama_kategori' => 'required',
        ],[
            'nama_kategori.required' => 'Nama Kategori Tidak Boleh Kosong',
        ]);
        $data = new Kategori;
        $data->nama_kategori = $request->nama_kategori;
        $data->parent_id = $request->parent_id;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori, $id)
    {
        $kategori = Kategori::findOrFail($id);
        return $kategori;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',
        ],[
            'nama_kategori.required' => 'Nama Kategori Tidak Boleh Kosong',
        ]);
        $data = Kategori::findOrFail($id);
        $data->nama_kategori = $request->nama_kategori;
        $data->parent_id = $request->parent_id;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
    }

    public function removedata(Request $request)
    {
        $kategori = Kategori::find($request->input('id'));
        if($kategori->delete())
        {
            echo 'Data Deleted';
        }
    }
}
