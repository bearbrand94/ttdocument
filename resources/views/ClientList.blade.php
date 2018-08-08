@extends('adminlte::page')

@section('title', 'Client Manager')

@section('content_header')
    <h1>Client Manager</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Client</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" id="t_clients">
                    <thead id="th_item">
                        <th>UID#</th>
                        <th>Nama</th>
                        <th>E-Mail</th>
                        <th>Alamat</th>
                        <th>Telp.</th>
                        <th class="text-center">Action</th>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <a type="button" class="btn btn-primary pull-right btn-flat btn-sm" href="{{ url('/client/new') }}">Add New Client</a>
        </div>
        <!-- /.box-footer -->
	</div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#t_clients').DataTable({
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ url('/client/list') }}"
            },
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'id', name: 'id' }
            ],
            "columnDefs": [ 
                {
                    // The `data` parameter refers to the data for the cell
                    "render": function ( data, type, row ) {
                        var button_code;
                        button_code = '<div class="btn-group" role="group">';
                        button_code += '<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi <span class="caret"></span></button>';
                        button_code += '<ul class="dropdown-menu dropdown-menu-right">';
                        // button_code += '    <li><a href="<?php echo url('/client/detail?id=')?>' + data + '">Detail</a></li>';
                        button_code += '    <li><a href="<?php echo url('/client/update?id=')?>' + data + '">Update</a></li>';
                        // button_code += '    <li><a href="<?php echo url('/client/delete?id=')?>' + data + '">Delete</a></li>';
                        button_code += '   </ul>';
                        button_code += '</div>';
                        return button_code;
                    },
                    "className": "text-center",
                    "targets": 5
                }
            ],
            "order": [0,"desc"] 
        });
        // $('#t_doc_receive_filter input').unbind();
        // $('#t_doc_receive_filter input').bind('keyup', function(e) {
        //     if(e.keyCode == 13) {
        //         oTable.fnFilter(this.value);   
        //     }
        // });
    });
</script>
@stop