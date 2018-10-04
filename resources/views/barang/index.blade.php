<!DOCTYPE html>
<html>
   <head>
      <title>Suplier</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
   </head>
   <body>
      <nav class="navbar navbar-default navbar-fixed-top">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">Rob Store</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
               <ul class="nav navbar-nav">
               <li class="active"><a href="{{url('bar')}}">Barang</a></li>
               <li><a href="{{url('sup')}}">Suplier</a></li>
               <li><a href="#contact">Penjualan</a></li>
            </div>
         </div>
      </nav>
      <br>
      <div class="container">
      <br />
      <br />
      <button type="button" name="add" id="Tambah" class="btn btn-primary pull-right">Tambah</button><br><br>
      <table id="stud" class="table table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>ID</th>
               <th width="300px">Nama Suplier</th>
               <th>Nama</th>
               <th>Merk</th>
               <th>Harga Satuan</th>
               <th>Stok</th>
               <th width="200px">
                  <center>Action</center>
               </th>
            </tr>
         </thead>
      </table>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      @include('barang.form')
      <script type="text/javascript">
         $(function() {
         $('#stud').DataTable({
         processing: true,
         serverSide: true,
         ajax: '/bar_json',
         columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_sup'},
            { data: 'nama', name: 'nama' },
            { data: 'merk', name: 'merk' },
            { data: 'harga_satuan', name: 'harga_satuan' },
            { data: 'stok', name: 'stok' },
            { data: 'action', orderable:false, searchable: false}
         ],
         "lengthMenu": [[-1, 10, 5, 2], ["All", 10, 5, 2]]
         })
         $('#Tambah').click(function(){
              $('#supModal').modal('show');
              $('#sup_form')[0].reset();
              $('#aksi').val('Tambah');
              $('.modal-title').text('Tambah Data');
              state = "insert";
            });
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
               url: "{{url ('/add_bar')}}",
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
               url: "{{url ('/sup/edit')}}"+ '/' + $('#id').val(),
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
      })
        });
      </script>