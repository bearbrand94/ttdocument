@extends('adminlte::page')

@section('title', 'Detail Terima Dokumen')

@section('content_header')
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
            <a type="button" class="btn btn-primary pull-right btn-flat btn-sm" style="margin-right: 5px;" href="<?php echo url('/document/receive/print') ?>?id={{$header->id}}">Print</a>
            <button type="button" class="btn btn-success pull-right btn-flat btn-sm" style="margin-right: 5px;">Terima</button>
            <button type="button" class="btn btn-danger pull-right btn-flat btn-sm" style="margin-right: 5px;">Tolak</button>
        </div>
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
@stop

@section('js')
<script type="text/javascript"> 

    function ubah(param){
        alert("ubah-"+param);
    }

    function hapus(param){
        alert("hapus-"+param);
    }

    $(document).ready(function() {
        $('#send_detail').DataTable( {
        });

      console.log('Hi!'); 
      var _backendData = JSON.parse('{!! json_encode($detail) !!}');
      console.log(_backendData);
    } );    
</script>
@stop