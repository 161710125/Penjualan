<!DOCTYPE html>
<html>
<head>
    <title>Penjualan</title>
</head>
<body>
    <div id="jualModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="jual_form" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_tampil"></span>
                  <input type="hidden" name="id" id="id">

                  <div class="form-group">
                     <label>Kode Penjualan</label>
                     <input type="text" name="kode_penjualan" id="kode_penjualan" class="form-control" placeholder="masukan kode barang">
                     <span class="help-block has-error kode_penjualan_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Tanggal Jual</label>
                     <input type="date" name="tgl_jual" id="tgl_jual" class="form-control">
                     <span class="help-block has-error tgl_jual_error"></span>
                  </div>

                  <div class="form-group">
                     <label>Nama Pelanggan</label>
                     <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" placeholder="masukan nama anda">
                     <span class="help-block has-error nama_pelanggan_error"></span>
                  </div>

                  <div class="form-group {{ $errors->has('kat_id') ? 'has-error' : '' }}">
                     <label>Kategori Barang</label>
                     <select class="form-control select-dua" name="kat_id" id="kat_id" style="width: 468px">
                        <option disabled selected>Pilih kategori Barang</option>
                        @foreach($barkategori as $data)
                        <option value="{{$data->id}}">{{$data->nama_kategori}}</option>
                        @endforeach
                     </select>
                     <span class="help-block has-error Nama_Kategori_error">
                  </div>

                  <div class="form-group">
                     <label>Nama Barang Berdasarkan Kategori</label>
                     <select name="sub_id" id="sub_id" class="form-control" style="width:468px">
                      <option disabled selected>Pilih Nama Barang</option>
                     </select>
                     <span class="help-block has-error sub_id_error"></span>
                  </div>

                  <div class="form-group {{ $errors->has('id_barang') ? 'has-error' : '' }}">
                     <label>Merk Barang</label>
                     <select class="form-control select-dua" name="id_barang" id="id_barang" style="width: 468px">
                        <option disabled selected>Pilih kategori Barang</option>
                        @foreach($barang as $data)
                        <option value="{{$data->id}}">{{$data->merk}}</option>
                        @endforeach
                     </select>
                     <span class="help-block has-error Merk_error">
                  </div>

                  <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="masukan jumlah minimal 1">
                    <span class="help-block has-error jumlah_error"></span>
                  </div>

                  <!-- <div class="form-group">
                    <label>Total Jual</label>
                    <input type="text" id="Total_Bayar" name="Total_Bayar" class="form-control" placeholder="masukan merk barang">
                    <span class="help-block has-error Merk_error"></span>
                  </div> -->

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