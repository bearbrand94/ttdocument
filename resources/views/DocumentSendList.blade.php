@extends('adminlte::page')

@section('title', 'Kirim Dokumen')

@section('content_header')
    <h1>Kirim Dokumen</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Pengajuan Kirim Dokumen</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" id="t_doc_send">
                    <thead id="th_item">
                        <th>Tanggal Pengajuan</th>
                        <th>No Surat.</th>
                        <th>Diajukan Oleh</th>
                        <th>Diajukan Kpd</th>
                        <th>Diserahkan Client</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Note</th>
                        <th class="text-center">Action</th>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
        
        <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right btn-flat btn-sm">Buat Pengajuan Baru</button>
        </div>
        <!-- /.box-footer -->
    </div>
@stop

@section('js')
<script type="text/javascript"> 
    $(document).ready(function() {
        $('#t_doc_send').DataTable( {
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ url('/document/send/list') }}"
            },
            "columns": [
                { data: 'created_at', name: 'created_at' },
                { data: 'letter_number', name: 'letter_number' },
                { data: 'requested_by', name: 'requested_by' },
                { data: 'submitted_to', name: 'submitted_to' },
                { data: 'send_to', name: 'send_to' },
                { data: 'approval_status', name: 'approval_status' },
                { data: 'note', name: 'note' },
                { data: 'id', name: 'id' }
            ],
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell
                    "render": function ( data, type, row ) {
                        var span_code;
                        if(data == 0){
                            span_code = "<span class='label label-primary'>" + "Pending";
                        }
                        else if(data == 1){
                            span_code = "<span class='label label-success'>" + "Confirmed";
                        }
                        else if(data == 2){
                            span_code = "<span class='label label-default'>" + "Rejected";
                        }

                        return span_code + "</span>";
                    },
                    "className": "text-center",
                    "targets": 5
                },
                {
                    // The `data` parameter refers to the data for the cell
                    "render": function ( data, type, row ) {
                        var button_code;
                        button_code = '<div class="btn-group" role="group">';
                        button_code += '<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi <span class="caret"></span></button>';
                        button_code += '<ul class="dropdown-menu dropdown-menu-right">';
                        button_code += '    <li><a href="<?php echo url('/document/send/detail?id=')?>' + data + '">Detail</a></li>';
                        button_code += '    <li><a href="<?php echo url('/document/send/update?id=')?>' + data + '">Update</a></li>';
                        button_code += '    <li><a href="<?php echo url('/document/send/delete?id=')?>' + data + '">Delete</a></li>';
                        button_code += '</ul></div>';
                        return button_code;
                    },
                    "className": "text-center",
                    "targets": 7
                }
            ]
        });
    } );    
</script>
@stop