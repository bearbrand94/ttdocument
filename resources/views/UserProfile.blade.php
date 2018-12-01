@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>My Profile</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <!-- box Data User -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data User</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="user-event-table">
                <tbody>
                  <tr>
                    <td class="col-md-3">Nama</td>
                    <td class="col-md-9">{{$detail->name}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Alamat E-Mail</td>
                    <td class="col-md-9">{{$detail->email}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Current Access</td>
                    <td class="col-md-9">{{$role->name}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Access List</td>
                    <td class="col-md-9">
                      @foreach($role->permissions as $key => $permission)
                        <li class='list-group-item'>{{$key}}</li>
                      @endforeach
                    </td>
                  </tr>
                </tbody>
            </table>              
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->

<!-- Validation Modal -->
<div class="modal" tabindex="-1" id="validation_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Validation Error</h4>
      </div>
      <div class="modal-body">
        <p id="validation_error_message">One fine body</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Confirmation Modal -->
<div class="modal" tabindex="-1" id="confirmation_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <p id="validation_error_message">Anda akan mengganti hak akses <b>{{$detail->name}}</b> sebagai <b><u id="access-name-confirmation"></u></b>  . Lanjutkan?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success btn-sm btn-flat" data-dismiss="modal" onclick="submit_change_access()">Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop

@section('js')
<script type="text/javascript">
    function submit_change_access(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.post( "{{ url('/user/access/change') }}", 
      {
        user_id: {{$detail->id}},              
        role_id: $(".select-role").val(),
      },
      function(data, status){
          alert(data.payload);    
          window.location.replace("{{ url('/user') }}");
      });
    };
</script>
@stop