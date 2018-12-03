@extends('adminlte::page')

@section('title', 'Detail Terima Dokumen')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Data Dokumen</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <div class="box box-widget">
        <div class="box-header with-border">
          <strong>Data Pengajuan</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <span>Pengajuan No. <strong>{{$header->letter_number}}</strong></span>
            <span>, dibuat pada tanggal {{date('d M Y', strtotime($header->created_at))}}</span><br>
            <span>Diterima Dari Client: <strong>{{$header->client_name}}</strong></span><br>
            <span>Dibuat Oleh Receptionist: <strong>{{$header->r1_name}}</strong></span><br>
            <span>Ditujukan kepada Staff: <strong>{{$header->r2_name}}</strong></span><br>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <span class="pull-right">Status: 
                @if ($header->review_status == 0)
                    <span class="label label-primary">Menunggu Konfirmasi Staff</span>
                @elseif ($header->review_status == 1)
                    <span class="label label-success">Diterima Oleh Staff</span>
                @elseif ($header->review_status == 2)
                    <span class="label label-danger">Ditolak Oleh Staff</span>
                @endif
            </span><br>
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- /.box -->

    <div class="box box-widget">
        <div class="box-header with-border">
          <strong>Detail Pengajuan</strong>
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
                        <th>CrID#</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($detail as $detail_data)
                  <tr>
                    <td>{{$detail_data->id}}</td>
                    <td>{{$detail_data->description}}</td>
<!--                     <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a onclick="ubah({{$detail_data->id}})">Ubah</a></li>
                                <li><a onclick="hapus({{$detail_data->id}})">Hapus</a></li>
                            </ul>
                        </div>
                    </td> -->
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <!-- <button type="button" class="btn btn-primary pull-right btn-flat btn-sm">Tambah Detail Baru</button> -->
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- /.box -->


    <div class="box box-widget">
        <div class="box-header with-border">
          <strong>Aksi Dokumen</strong>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <a type="button" class="btn btn-primary pull-right btn-flat btn-sm" style="margin-right: 5px;" href="<?php echo url('/document/receive/print') ?>?id={{$header->id}}" target="_blank">Print</a>
            @can('review-document-receive')
            <button type="button" class="btn btn-success pull-right btn-flat btn-sm" style="margin-right: 5px;" onclick="$('#accept_review_modal').modal();">Terima</button>
            <button type="button" class="btn btn-danger pull-right btn-flat btn-sm" style="margin-right: 5px;" onclick="$('#reject_review_modal').modal();">Tolak</button>
            @endcan
        </div>
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->

<!-- Accept Review Document Modal -->
<div class="modal" tabindex="-1" id="accept_review_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Review Document</h4>
      </div>
      <div class="modal-body">
        <label for="note">Berikan catatan mengapa anda menerima dokumen.</label>
        <input type="email" class="form-control" id="accept_note" placeholder="Masukkan catatan anda">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success btn-flat btn-sm" data-dismiss="modal" onclick="accept()">Terima</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Reject Review Document Modal -->
<div class="modal" tabindex="-1" id="reject_review_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Review Document</h4>
      </div>
      <div class="modal-body">
        <label for="note">Berikan catatan mengapa anda menolak dokumen.</label>
        <input type="email" class="form-control" id="reject_note" placeholder="Masukkan alasan anda">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-flat btn-sm" data-dismiss="modal" onclick="reject()">Tolak</button>
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
    $(document).ready(function() {
    });

    function accept(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post( "{{ url('/document/receive/accept') }}", 
        {
            id: {{$header->id}},
            note: $("#accept_note").val()
        },
        function(data, status){
            alert(data.payload);    
            window.location.replace("{{ url('/document/receive') }}");
        }); 
    }

    function reject(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post( "{{ url('/document/receive/reject') }}", 
        {
            id: {{$header->id}},
            note: $("#reject_note").val()
        },
        function(data, status){
            alert(data.payload);    
            window.location.replace("{{ url('/document/receive') }}");
        });     
    }

</script>
@stop