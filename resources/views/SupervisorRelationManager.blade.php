@extends('adminlte::page')

@section('title', 'Relation Manager-Supervisor')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <h1>Form Terima Dokumen Baru</h1> -->
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Supervisor</strong>
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
                  <label for="select_supervisor">Pilih Supervisor:</label>
                  <select class="form-control" id="select-supervisor">
                    @foreach($supervisors as $supervisor)
                        <option value="{{$supervisor->id}}">{{$supervisor->name}}</option>
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
          <strong>Staff</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
            <table class="table table-bordered" id="user-event-table">
                <tbody>
                  <tr>
                    <td class="col-md-3">Staff Yang Ditangani:</td>
                    <td class="col-md-9 staff-list">
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
        <label for="document_description">Pilih Staff</label>
        <select class="form-control" id="select-staff">
          @foreach($staffs as $staff)
              <option value="{{$staff->id}}">{{$staff->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal" onclick="add_staff()">Add</button>
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

    $("#select-supervisor").change(function() {    
        $(".staff-list").html("");

        @foreach($supervisors as $supervisor)
          if(this.value == {{$supervisor->id}}){
              @foreach($supervisor->staffs as $staff)
                var delete_button = "<button type='button' class='pull-right' onclick=remove_staff({{$staff->id}})>Hapus</button>"
                $(".staff-list").append("<li class='list-group-item'>{{$staff->name}}" + delete_button + "</li>");
              @endforeach
          }
        @endforeach 
        if($(".staff-list").html() == ""){
          $(".staff-list").html("Tidak ada staff yang ditangani.");
        }
    });

    $(document).ready(function(){
      $("#select-supervisor").change();
    });

    function add_staff(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.post( "{{ url('/relation/supervisor/add') }}", 
      {       
        supervisor_id: $("#select-supervisor").val(),
        staff_id: $("#select-staff").val()
      },
      function(data, status){
          alert(data.payload);    
          window.location.replace("{{ url('/relation/supervisor/manage') }}");
      });
    };

    function remove_staff(staff_id){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.post( "{{ url('/relation/supervisor/delete') }}", 
      {       
        supervisor_id: $("#select-supervisor").val(),
        staff_id: staff_id
      },
      function(data, status){
          alert(data.payload);    
          window.location.replace("{{ url('/relation/supervisor/manage') }}");
      });
    };
</script>
@stop