<!DOCTYPE html>
<html>
<head>
    <title>Barang</title>
</head>
<body>
    <div id="barangModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="barang_form" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_tampil"></span>
               
                  <div class="form-group {{ $errors->has('id_suplier') ? 'has-error' : '' }}">
                     <input type="hidden" name="id" id="id">

                     <label>Nama Suplier</label>
                     <select class="form-control select-dua" name="id_suplier" id="id_suplier" style="width: 468px">
                        <option disabled selected>Pilih Suplier</option>
                        @foreach($suplier as $data)
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_suplier'))
                     <span class="help-block has-error nama_error">
                        <strong>{{$errors->first('id_suplier')}}</strong>
                     </span>
                     @endif
                  </div>

                  <div class="form-group {{ $errors->has('kat_id') ? 'has-error' : '' }}">
                     <input type="hidden" name="id" id="id">

                     <label>Nama Kategori</label>
                     <select class="form-control select-dua" name="kat_id" id="kat_id" style="width: 468px">
                        <option disabled selected>Pilih Kategori</option>
                        @foreach($barangkategori as $data)
                        <option value="{{$data->id}}">{{$data->nama_kategori}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('kat_id'))
                     <span class="help-block has-error nama_Kategori_error">
                        <strong>{{$errors->first('kat_id')}}</strong>
                     </span>
                     @endif
                  </div>

                  <div class="form-group">
                     <label>Nama Barang Berdasarkan Kategori</label>
                     <select name="id_parent" id="id_parent" class="form-control" style="width:468px">
                     </select>
                     <span class="help-block has-error id_parent_error"></span>
                  </div>

                  <div class="form-group">
                    <label>merk Barang</label>
                    <input type="text" id="merk" name="merk" class="form-control" placeholder="masukan merk barang">
                    <span class="help-block has-error merk_error"></span>
                  </div>

                  <div class="form-group">
                    <label>Harga Satuan ( Rupiah )</label>
                    <input type="text" id="harga_satuan" name="harga_satuan" class="form-control" placeholder="Rp.">
                    <span class="help-block has-error harga_satuan_error"></span>
                  </div>

                  <div class="form-group">
                    <label>stok Barang</label>
                    <input type="number" id="stok" name="stok" class="form-control" placeholder="jumlah stok barang">
                    <span class="help-block has-error stok_error"></span>
                  </div>

                <div class="modal-footer">
                    <input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
                    <input type="button" value="Cancel" class="btn btn-default" data-dismiss="modal"/>
                </div>
               </form>
            </div>
         </div>
      </div>

</body>
</html>