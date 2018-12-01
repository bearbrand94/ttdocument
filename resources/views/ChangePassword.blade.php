@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Ubah Password</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <!-- box Data User -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Form Ubah Password</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">
            <table class="table table-bordered" id="user-event-table">
                <tbody>
                  <tr>
                    <td class="col-md-3">Password Lama</td>
                    <td class="col-md-9"><input type="password" class="form-control" id="old_password"></td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Password Baru</td>
                    <td class="col-md-9"><input type="password" class="form-control" id="new_password"></td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Ulangi Password Baru</td>
                    <td class="col-md-9"><input type="password" class="form-control" id="new_confirm_password"></td>
                  </tr>
                </tbody>
            </table>              
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success btn-sm pull-right btn-flat" onclick="submit_change_access()">Submit</button>
          <a type="submit" class="btn btn-danger btn-sm pull-right btn-flat" style="margin-right: 5px;" href="{{ url('/home') }}">Kembali</a>
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
@stop

@section('js')
<script type="text/javascript">
    function submit_change_access(){
      if(validate_input()){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post( "{{ url('/user/password/change') }}", 
        {
          old_password : $("#old_password").val(),
          new_password : $("#new_password").val(),
        },
        function(data, status){
            alert(data.payload); 
            if(data.code==200){
              window.location.replace("{{ url('/home') }}");
            }
               
            
        });
      };
    };

    function validate_input(){
        var message="";
        var flag_error=0;
        if($("#old_password").val() == ""){
            flag_error=1;
            message += "<b>Password Lama Harus Diisi</b><br>"
        }
        if($("#new_password").val() == ""){
            flag_error=1;
            message += "<b>Password Baru Harus Diisi</b><br>"
        }
        if($("#new_confirm_password").val() == ""){
            flag_error=1;
            message += "<b>Ulangi Password Baru Harus Diisi</b><br>"
        }
        else{
          if($("#new_password").val() != $("#new_confirm_password").val()){
              flag_error=1;
              message += "<b>Ulangi Password Baru Tidak Sesuai.</b><br>"
          }
        }
        if(flag_error==0){
            return true;
        }
        $("#validation_error_message").html(message);
        $("#validation_modal").modal();
        return false;
    };
</script>
@stop