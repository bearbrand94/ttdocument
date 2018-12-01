@extends('adminlte::page')

@section('title', 'Update Client')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Form Update Client</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data Client</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">
            <!-- form start -->
                <div class="form-group">
                  <label for="client_name">Nama</label>
                  <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Masukkan Nama Client" value="{{$client_data->name}}">
                </div>
                <div class="form-group">
                  <label for="client_address">Alamat</label>
                  <input type="text" class="form-control" id="client_address" name="client_address" placeholder="Masukkan Alamat Client" value="{{$client_data->address}}">
                </div>
                <div class="form-group">
                  <label for="client_address">No.Telp</label>
                  <input type="text" class="form-control" id="client_phone" name="client_phone" placeholder="Masukkan Nomor Telepon Client" value="{{$client_data->phone}}">
                </div>
                <div class="form-group">
                  <label for="client_address">E-Mail</label>
                  <input type="email" class="form-control" id="client_email" name="client_email" placeholder="Masukkan Alamat E-Mail Client" value="{{$client_data->email}}">
                </div>                
            
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-success btn-sm pull-right btn-flat" onclick="request_ttd()">Submit</button>
          <a type="submit" class="btn btn-danger btn-sm pull-right btn-flat" style="margin-right: 5px;" href="{{ url('/client') }}">Kembali</a>
        </div>
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
        <p id="validation_error_message">Pastikan data yang telah diisi telah benar sebelum permohonan dikirim kepada staff.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-sm btn-flat" data-dismiss="modal" onclick="request_ttd()">Kirim</button>
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
    function request_ttd(){
        if(validate_input()){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.post( "{{ url('/client/update') }}", 
            {
              client_id: {{$client_data->id}},              
              client_name: $("#client_name").val(),
              client_address: $("#client_address").val(),
              client_phone: $("#client_phone").val(),
              client_email: $("#client_email").val()
            },
            function(data, status){
                alert(data.payload);    
                window.location.replace("{{ url('/client/manage') }}");
            });         
        }

    }

    function validate_input(){
        // alert("A");
        var flag_error=0;
        var message="Gagal membuat Pengajuan Kirim Dokumen karena terdapat beberapa kesalahan sebagai berikut:<br>";
        if($("#client_name").val() == ""){
            flag_error=1;
            message += "<b>Nama Client Harus Diisi</b><br>"
        }
        if($("#client_address").val() == ""){
            flag_error=1;
            message += "<b>Alamat Client Harus Diisi</b><br>"
        }
        if($("#client_phone").val() == ""){
            flag_error=1;
            message += "<b>Telepon Client Harus Diisi</b><br>"
        }
        if($("#client_email").val() == ""){
            flag_error=1;
            message += "<b>E-Mail Client Harus Diisi</b><br>"
        }
        if(flag_error==0){
            return true;
        }
        $("#validation_error_message").html(message);
        $("#validation_modal").modal();
        return false;
    }
</script>
@stop