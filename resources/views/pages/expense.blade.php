@extends('layouts.master')

@section('content')



<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Pengeluaran</a>
      </li>
      <li class="breadcrumb-item active">Pengeluaranmu</li>
    </ol>
    <h2> Uangmu = RP.<?php echo number_format($wallet['uang'],0,",","."); ?>   </h2>
    @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content') !!}
    </div>
@endif

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Tabel Pengeluaran</div>
      <div class="card-body">
        <div class="table table-responsive">
    <table class="table table-bordered" id="table">
      <tr>
        <th width="150px">No</th>
        <th>Nama Pengeluaran</th>
        <th>Biaya Pengeluaran</th>
        <th>Tanggal Pengeluaran</th>
        <th class="text-center" width="150px">
          <a href="#" class="create-modal btn btn-success btn-sm">
            <i class="fa fa-plus"></i>
          </a>
        </th>
      </tr>

       <?php  $no=1; ?>
         @foreach ($expenses as $value)
        <tr class="post{{$value->id}}">
          <td>{{ $no++ }}</td>
          <td>{{ $value->nama_pengeluaran }}</td>
          <td>Rp. <?php echo number_format($value->biaya_pengeluaran ,0,",","."); ?> </td>
          <td>{{ $value->tgl_pengeluaran }}</td>
          <td>
            <center>
              <button class="btn btn-info" data-mynama="{{$value->nama_pengeluaran}}" data-mytgl="{{$value->tgl_pengeluaran}}" data-mybiaya={{$value->biaya_pengeluaran}} data-catid={{$value->id}} data-toggle="modal" data-target="#edit"><i class="fa fa-pencil"></i></button>
              <button class="btn btn-danger" data-catid={{$value->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o"></i></button>

          </center>
          </td>
        </tr>
        @endforeach
    </table>
  </div>

</div>
{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="click_save" role="form" action="/expense/addExp" method="post">
            @csrf

          <div class="form-group row add">
            <label class="control-label col-sm-5" for="nama_peng">Nama Pengeluaran :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_peng" name="nama_peng"
              placeholder="Enter " required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-5" for="body">Jumlah Pengeluaran :</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jmlh" name="jmlh"
              placeholder="Enter" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-5" for="tgl">Tanggal Pengeluaran :</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tgl" name="tgl"
              placeholder="Enter" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>

      </div>
          <div class="modal-footer">
            <button class="btn btn-warning" type="submit" >
              <span class="glyphicon glyphicon-plus"></span>Save Pemasukan
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span>Close
            </button>
          </div>
    </div>
        </form>
  </div>
</div></div>

{{-- Modal Form Edit and Delete Post --}}
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
      </div>
      <form action="/expense/edit_expense" method="post">
          @csrf
	      <div class="modal-body">
	      		<input type="hidden" name="id" id="cat_id" value="">

            <div class="form-group">
              <label for="nama">Nama Pengeluaran</label>
              <input type="text" class="form-control" name="nama" id="nama">
            </div>

            <div class="form-group">
              <label for="biaya">Biaya Pengeluaran</label>
              <input type="number" name="biaya" id="biaya"  class="form-control">
            </div>

            <div class="form-group">
              <label for="tgl">Tanggal Pengeluaran</label>
              <input type="date" class="form-control" name="tgl" id="tgl">
            </div>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save Changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>
                {{-- Form Delete Post --}}
                <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                      </div>
                      <form action="/expense/del_expense" method="post">
                          @csrf
                      		{{-- {{method_field('delete')}}
                      		{{csrf_field()}} --}}
                	      <div class="modal-body">
                				<p class="text-center">
                					Are you sure you want to delete this?
                				</p>
                	      		<input type="hidden" name="id" id="cat_id" value=" ">

                	      </div>
                	      <div class="modal-footer">
                	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                	        <button type="submit" class="btn btn-warning">Yes, Delete</button>
                	      </div>
                      </form>
                    </div>
                  </div>
                </div>


@endsection

@section('add_js')
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="/assets/js/modal2.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
{{-- <script  src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> --}}
{{-- <link rel="stylesheet"  href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.8/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet"  href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
      {{-- <script>
          $(document).ready(function(){
              $('#table').DataTable({
                  paging: false,
                  order: []
              });
          });
          </script> --}}
          <script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 <script src="{{asset('js/app.js')}}"></script>


 <script>
 $('#delete').on('show.bs.modal', function (event) {

     var button = $(event.relatedTarget)

     var cat_id = button.data('catid')
     var modal = $(this)

     modal.find('.modal-body #cat_id').val(cat_id);
})

$('#edit').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var nama = button.data('mynama')
    var tgl = button.data('mytgl')
    var biaya = button.data('mybiaya')
    var cat_id = button.data('catid')
    var modal = $(this)

    modal.find('.modal-body #nama').val(nama);
    modal.find('.modal-body #biaya').val(biaya);
    modal.find('.modal-body #tgl').val(tgl);
    modal.find('.modal-body #cat_id').val(cat_id);
})

// $( "#click_save" ).submit(function( event ) {
//     var button = $(event.relatedTarget);
//     var biaya = button.data('mybiaya')
//     if(biaya > $('h3').text()   ){
//   alert( "Handler for .submit() called." );}
//   event.preventDefault();
// });

</script>

@endsection
