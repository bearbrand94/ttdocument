@extends('adminlte::page')

@section('title', 'Detail Kirim Dokumen')

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
            <span>, dibuat pada tanggal {{date('d M Y, H:i', strtotime($header->created_at))}}</span><br>
            <span>Diajukan Oleh Staff: <strong>{{$header->requested_by}}</strong></span><br>
            <span>Dikirim kepada Client: <strong>{{$header->send_to}}</strong></span><br>
            <span>Diserahkan Kepada Receptionist: <strong>{{$header->submitted_to}}</strong></span><br>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <span class="pull-left">Status: 
                @if ($header->approval_status == 0)
                    <span class="label label-primary">Menunggu Konfirmasi Supervisor</span>
                @elseif ($header->approval_status == 1)
                    <span class="label label-success">Diterima Oleh Supervisor</span>
                @elseif ($header->approval_status == 2)
                    <span class="label label-danger">Ditolak Oleh Supervisor</span>
                @endif
            </span><br>
            @if ($header->note != "")
              <p class="">
                Catatan: <b>{{$header->note}}</b>
              </p>
            @endif
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
            <a type="button" class="btn btn-primary pull-right btn-flat btn-sm" style="margin-right: 5px;" href="<?php echo url('/document/send/print') ?>?id={{$header->id}}" target="_blank">Print</a>
            @can('review-document-send')
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
    }) 

    function accept(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post( "{{ url('/document/send/accept') }}", 
        {
            id: {{$header->id}},
            note: $("#accept_note").val()
        },
        function(data, status){
            alert(data.payload);    
            window.location.replace("{{ url('/document/send') }}");
        }); 
    }

    function reject(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.post( "{{ url('/document/send/reject') }}", 
        {
            id: {{$header->id}},
            note: $("#reject_note").val()
        },
        function(data, status){
            alert(data.payload);    
            window.location.replace("{{ url('/document/send') }}");
        });     
    }
</script>
@stop