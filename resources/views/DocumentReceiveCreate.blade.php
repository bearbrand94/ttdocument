@extends('adminlte::page')

@section('title', 'Terima Dokumen Baru')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Form Terima Dokumen Baru</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Header Dokumen</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">
            <!-- form start -->
            <form role="form">
                <div class="form-group">
                  <label for="exampleInputEmail1">Diterima Dari Client:</label>
                  <select class="form-control" id="select_client">
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                  </select>
                  <!-- <p class="help-block">Example block-level help text here.</p> -->
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Diserahkan Kepada Staff:</label>
                  <select class="form-control" id="select_staff">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                  <!-- <p class="help-block">Example block-level help text here.</p> -->
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box box-success">
        <div class="box-header with-border">
          <strong>Detail Dokumen</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <table class="table table-hover" id="user-event-table">
                <thead>
                    <tr>
                        <th class="text-center">#No.</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tb_detail_document">
                    <tr>
                        <td colspan="3">Belum Terdapat Detail Dokumen Yang Diterima, Tambahkan Detail Baru..</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right btn-flat btn-sm" onclick="$('#create_detail_modal').modal();">Tambah Detail Baru</button>
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- /.box -->


    <div class="box box-danger">
        <div class="box-header with-border">
          <strong>Aksi Dokumen</strong>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <button type="submit" class="btn btn-success btn-sm pull-right btn-flat" onclick="$('#confirmation_modal').modal();">Submit</button>
            <a type="submit" class="btn btn-danger btn-sm pull-right btn-flat" style="margin-right: 5px;" href="{{ url('/document/send') }}">Kembali</a>
        </div>
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->


<!-- Create Detail Modal -->
<div class="modal" tabindex="-1" id="create_detail_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Detail</h4>
      </div>
      <div class="modal-body">
        <label for="document_description">Deskripsi Dokumen</label>
        <input type="email" class="form-control" id="document_description" placeholder="Masukkan isi dokumen">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal" onclick="add_document()">Add</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
    var arrDocument=[];
    function add_document(){
        arrDocument.push($("#document_description").val());
        fill_detail_table();
        $("#document_description").val("");
    }
    function delete_document(index){
        arrDocument.splice(index,1);
        fill_detail_table();
    }

    function fill_detail_table(){
        var content="";
        for(i=0; i<arrDocument.length; i++){
            content += '<tr><td class="text-center">' + (i+1) + '</td>' + '<td>' + arrDocument[i] + '</td>';
            content += "<td class='text-center'><button type='button' class='btn btn-danger btn-flat btn-sm' onclick='delete_document(" + i + ")'>Hapus</button></td>";
            content += '</tr>';
        }       
        $("#tb_detail_document").html(content);
    }

    function request_ttd(){
        if(validate_input()){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.post( "{{ url('/document/receive/insert') }}", 
            {
                client_id: $("#select_client").val(),
                staff_id: $("#select_staff").val(),
                document: JSON.stringify(arrDocument)
            },
            function(data, status){
                alert(data.payload);    
                window.location.replace("{{ url('/document/receive') }}");
            });         
        }
    }

    function validate_input(){
        // alert("A");
        var flag_error=0;
        var message="Gagal membuat Pengajuan Kirim Dokumen karena terdapat beberapa kesalahan sebagai berikut:<br>";
        if(arrDocument.length <= 0){
            flag_error=1;
            message += "<b>Detail Dokumen Yang Diterima Harus Ada Minimal 1.</b><br>"
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