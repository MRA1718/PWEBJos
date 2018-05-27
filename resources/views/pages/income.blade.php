@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Pemasukan</a>
      </li>
      <li class="breadcrumb-item active">Pemasukanmu</li>
    </ol>
    <h1> Uangmu = RP. {{$wallet['uang']}} </h1>


    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Data Table Example</div>
      <div class="card-body">
        <div class="table table-responsive">
    <table class="table table-bordered" id="table">
      <tr>
        <th width="150px">No</th>
        <th>Nama Pemasukan</th>
        <th>Biaya Pemasukan</th>
        <th>Tanggal Pemasukan</th>
        <th class="text-center" width="150px">
          <a href="#" class="create-modal btn btn-success btn-sm">
            <i class="fa fa-plus"></i>
          </a>
        </th>
      </tr>
       <?php  $no=1; ?>
         @foreach ($incomes as $value)
        <tr class="post{{$value->id}}">
          <td>{{ $no++ }}</td>
          <td>{{ $value->nama_pemasukan }}</td>
          <td>Rp. {{ $value->biaya_pemasukan }}</td>
          <td>{{ $value->tgl_pemasukan }}</td>
          <td>
            <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-title="" data-body="">
              <i class="fa fa-eye"></i>
            </a>
            <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="" data-title="" data-body="">
              <i class="fa fa-pencil"></i>
            </a>
            <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-title="" data-body="">
            <i class="fa fa-trash-o"></i>
            </a>
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
        <form class="form-horizontal" role="form" action="/income/addPost" method="post">
            @csrf

          <div class="form-group row add">
            <label class="control-label col-sm-5" for="nama_pem">Nama Pemasukan :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_pem" name="nama_pem"
              placeholder="Enter " required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-5" for="body">Jumlah Pemasukan :</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jmlh" name="jmlh"
              placeholder="Enter" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-5" for="tgl">Tanggal Pemasukan :</label>
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
{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
                  </div>
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="">ID :</label>
                      <b id="i"/>
                    </div>
                    <div class="form-group">
                      <label for="">Title :</label>
                      <b id="ti"/>
                    </div>
                    <div class="form-group">
                      <label for="">Body :</label>
                      <b id="by"/>
                    </div>
                    </div>
                    </div>
                  </div>
</div>
{{-- Modal Form Edit and Delete Post --}}
<div id="myModal"class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal">
          <div class="form-group">
            <label class="control-label col-sm-2"for="id">ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fid" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2"for="title">Title</label>
            <div class="col-sm-10">
            <input type="name" class="form-control" id="t">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2"for="body">Body</label>
            <div class="col-sm-10">
            <textarea type="name" class="form-control" id="b"></textarea>
            </div>
          </div>
        </form>
                {{-- Form Delete Post --}}
        <div class="deleteContent">
          Are You sure want to delete <span class="title"></span>?
          <span class="hidden id"></span>
        </div>
      </div>
      <div class="modal-footer">
        {{-- <form action="/income/del_income">
          <input type="hidden" name="id" value="{{$value->id}}">
          <button class="btn btn-danger" type="submit" >
            Delete
          </button>


        </form> --}}
        <button type="button" class="btn actionBtn" data-dismiss="modal">
         <span id="footer_action_button" class="glyphicon"></span>
       </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class="glyphicon glyphicon"></span>close
        </button>
      </div>
    </div>
  </div>
</div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection

@section('add_js')
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="/assets/js/modal.js"></script>
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
@endsection
