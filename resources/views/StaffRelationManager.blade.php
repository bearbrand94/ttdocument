@extends('adminlte::page')

@section('title', 'Relation Manager-Staff')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <h1>Form Terima Dokumen Baru</h1> -->
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Staff</strong>
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
                  <label for="select_supervisor">Pilih Staff:</label>
                  <select class="form-control" id="select-staff">
                    @foreach($staffs as $staff)
                        <option value="{{$staff->id}}">{{$staff->name}}</option>
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
          <strong>Client</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
            <table class="table table-bordered" id="client-list-table">
                <tbody>
                  <tr>
                    <td class="col-md-3">Client Yang Ditangani:</td>
                    <td class="col-md-9 client-list">
                      Tidak Ada.
                    </td>
                  </tr>
                </tbody>
            </table>        

        <!-- /.box-body -->
        <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right btn-flat btn-sm" onclick="$('#create_detail_modal').modal();">Tambah Relasi</button>
        </div>
        <!-- /.box-footer -->
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
        <h4 class="modal-title">Add Relation</h4>
      </div>
      <div class="modal-body">
        <label for="document_description">Pilih Client</label>
        <select class="form-control" id="select-client">
          @foreach($clients as $client)
              <option value="{{$client->id}}">{{$client->id}} - {{$client->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal" onclick="add_client()">Add</button>
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

    $("#select-staff").change(function() {    
        $(".client-list").html("");

        @foreach($staffs as $staff)
          if(this.value == {{$staff->id}}){
              @foreach($staff->clients as $client)
                var delete_button = "<button type='button' class='pull-right' onclick=remove_client({{$client->id}})>Hapus</button>"
                $(".client-list").append("<li class='list-group-item'>{{$client->name}}" + delete_button + "</li>");
              @endforeach
          }
        @endforeach 
        if($(".client-list").html() == ""){
          $(".client-list").html("Tidak ada client yang ditangani.");
        }
    });

    $(document).ready(function(){
      $("#select-staff").change();
    });

    function add_client(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.post( "{{ url('/relation/staff/add') }}", 
      {       
        staff_id: $("#select-staff").val(),
        client_id: $("#select-client").val()
      },
      function(data, status){
          alert(data.payload);    
          window.location.replace("{{ url('/relation/staff/manage') }}");
      });
    };

    function remove_client(client_id){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.post( "{{ url('/relation/staff/delete') }}", 
      {       
        staff_id: $("#select-staff").val(),
        client_id: client_id
      },
      function(data, status){
          alert(data.payload);    
          window.location.replace("{{ url('/relation/staff/manage') }}");
      });
    };
</script>
@stop