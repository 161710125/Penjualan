@extends('temp')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Tables Kategori</h1> 
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div> -->
        </div> 
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" name="add" id="Tambah" class="btn btn-primary">Add Data</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="stud" class="table table-bordered" style="width:100%">
                  <thead>
            <tr>
              		  <th>Nomor Id</th>
                      <th>Nama Barang dan Kategori</th>
                      <th>Berdasarkan Kategori Id</th>
                      <th>Action</th>
            </tr>
         </thead>
               </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
      @endsection
      @push('scripts')
      @include('kategori.form')
      <script type="text/javascript">
         $(function() {
         $('#stud').DataTable({
         processing: true,
         serverSide: true,
         ajax: '/kat_json',
         columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_kategori', name: 'nama_kategori' },
            { data: 'parent_id', name: 'parent_id'},
            { data: 'action', orderable:false, searchable: false}
         ],
         "lengthMenu": [[-1, 10, 5, 2], ["All", 10, 5, 2]]
         })
         $('#Tambah').click(function(){
              $('#supModal').modal('show');
              $('#sup_form')[0].reset();
              $('#aksi').val('Tambah');
              $('.modal-title').text('Tambah Data');
              $('.selecttt').select2();
              state = "insert";
            });
         
         $('.select').select2();
         $('#supModal').on('hidden.bs.modal', function(e){
          $(this).find('#sup_form')[0].reset();
          $('span.has-error').text('')
          $('.form-group.has-error').removeClass('has-error');
         });
         
           $('#sup_form').submit(function(e){
             $.ajaxSetup({
               header: {
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
               }
             });
             e.preventDefault();
             if (state == 'insert'){
             $.ajax({
               type: "POST",
               url: "{{url ('/add_kat')}}",
               // data: $('#sup_form').serialize(),
               data: new FormData(this),
               contentType: false,
               processData: false,
               dataType: 'json',
               success: function (data){
                 console.log(data);
                 $('#supModal').modal('hide');
                 $('#aksi').val('Tambah');
                 $('#stud').DataTable().ajax.reload();
                    swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '3500'
                            })
               },
               error: function (data){
                $('input').on('keydown keypress keyup click change', function(){
                  $(this).parent().removeClass('has-error');
                  $(this).next('.help-block').hide()
                });
                var coba = new Array();
                console.log(data.responseJSON.errors);
                $.each(data.responseJSON.errors,function(name, value){
                  console.log(name);
                  coba.push(name);
                  $('input[name='+name+']').parent().addClass('has-error');
                  $('input[name='+name+']').next('.help-block').show().text(value);
                });
                $('input[name='+coba[0]+']').focus();
               }
             }); 
           }else {
            $.ajax({
               type: "POST",
               url: "{{url ('/kat/edit')}}"+ '/' + $('#id').val(),
               // data: $('#sup_form').serialize(),
               data: new FormData(this),
               contentType: false,
               processData: false,
               dataType: 'json',
               success: function (data){
                 console.log(data);
                 $('#supModal').modal('hide');
                 $('#stud').DataTable().ajax.reload();
                 swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '3500'
                            })
               },
               error: function (data){
                $('input').on('keydown keypress keyup click change', function(){
                  $(this).parent().removeClass('has-error');
                  $(this).next('.help-block').hide()
                });
                var coba = new Array();
                console.log(data.responseJSON.errors);
                $.each(data.responseJSON.errors,function(name, value){
                  console.log(name);
                  coba.push(name);
                  $('input[name='+name+']').parent().addClass('has-error');
                  $('input[name='+name+']').next('.help-block').show().text(value);
                });
                $('input[name='+coba[0]+']').focus();
               }
             }); 
           }
             
           });
           $(document).on('click', '.delete', function(){
         var dele = $(this).attr('id');
         if(confirm("Apakah Anda Yakin Menghapus Data Ini?"))
         {
            $.ajax({
                url:"{{route('deletekat')}}",
                method:"get",
                data:{id:dele},
                success:function(data)
                {
                  $('#stud').DataTable().ajax.reload();
                    swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '3500'
                            })
         
                }
            })
         }
         else
         {
          swal({
            title: 'Batal',
            text: 'Data tidak jadi dihapus',
            type: 'error'
          })
            return false;
         }
         }); 
         });
         $(document).on('click', '.edit', function(){
         var edit = $(this).data('id');
         $('#form_output').html('');
         $.ajax({
            url:"{{url('katedit')}}" + '/' + edit,
            method:'get',
            data:{id:edit},
            dataType:'json',
            success:function(data)
            {
              console.log(data);
                state = "update";
                $('#id').val(data.id);
                $('#nama_kategori').val(data.nama_kategori);
                $('#supModal').modal('show');
                $('#aksi').val('Edit');
                $('.modal-title').text('Edit Data');
            },
         })
         });
      </script>
      @endpush