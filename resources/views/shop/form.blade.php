<div id="supModal" class="modal fade" role="dialog" data-backdrop="static">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="POST" id="sup_form" enctype="multipart/form-data">
                {{csrf_field()}} {{ method_field('POST') }}
                  <div class="modal-header" style="background-color: lightblue;">
                     <button type="button" class="close" data-dismiss="modal" >&times;</button>
                     <h4 class="modal-title" >Add Data</h4>
                  </div>
                  <div class="modal-body">
                     
                     <span id="form_output"></span>
                     <input type="hidden" name="id" id="id">

                     <div class="form-group">
                        <label>Kode Barang :</label>
                        <input type="text" name="kode_penjualan" id="kode_penjualan" class="form-control" placeholder="John Bred" />
                        <span class="help-block has-error kode_penjualan_error"></span>
                     </div>

                     <div class="form-group">
                        <label>Tanggal Jual :</label>
                        <input type="date" name="tgl_jual" id="tgl_jual" class="form-control"/>
                        <span class="help-block has-error tgl_jual_error"></span>
                     </div>

                     <div class="form-group">
                        <label>Nama Pelanggan :</label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" placeholder="John Bred" />
                        <span class="help-block has-error nama_pelanggan_error"></span>
                     </div>

                    <div class="form-group">
                        <label>Nama :</label>
                        <select id="id_barang" name="id_barang" class="form-control selecttt" style="width: 568px">
                            <option selected disabled>Pilih Barang</option>
                            @foreach($barang as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <span class="help-block has-error id_barang_error"></span>
                     </div>

                     <div class="form-group">
                        <label>Jumlah :</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="99" />
                        <span class="help-block has-error jumlah_error"></span>
                     </div>

                     <!-- <div class="form-group">
                        <label>Jumlah :</label>
                        <input type="number" name="total_bayar" id="total_bayar" class="form-control" placeholder="99999" />
                        <span class="help-block has-error total_bayar_error"></span>
                     </div> -->

                     <!-- <input type="hidden" name="total_bayar" id="total_bayar"> -->

                  <div class="modal-footer">
                    <input type="hidden" name="student_id" id="student_id" value=""/>
                    <input type="hidden" name="button_action" id="button_action" value="insert"/>
                     <input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
                     <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                  </div>
               </form>
            </div>
         </div>
      </div>