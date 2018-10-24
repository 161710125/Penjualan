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
                    <div class="form-group">
                     <input type="hidden" name="id" id="id">
               
                     <label>Nama Kategori/Barang</label>
                     <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="masukan data" />
                     <span class="help-block has-error nama_kategori_error"></span>
                  </div>

                  <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                     <label>Kategori</label>
                     <select class="form-control select-dua" name="parent_id" id="parent_id" style="width: 468px">
                        <option disabled selected>Pilih Kategori Barang</option>
                        @foreach($kategori as $data)
                        <option value="{{$data->id}}">{{$data->nama_kategori}}</option>
                        @endforeach
                     </select>
                     <span class="help-block has-error parent_id_error">
                  </div>
               </div>

                     

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