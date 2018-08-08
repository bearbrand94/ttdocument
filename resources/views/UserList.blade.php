
    
@extends('adminlte::page')

@section('title', 'User Manager')

@section('content_header')
    <h1>User Manager</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar User</h3>
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
                <table class="table table-bordered" width="100%" cellspacing="0" id="t_doc_receive">
                    <thead id="th_item">
                        <th>UID#</th>
                        <th>Nama User</th>
                        <th>E-Mail</th>
                        <th>Hak Akses</th>
                        <th class="text-center">Action</th>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right btn-flat btn-sm">Add New User</button>
        </div>
        <!-- /.box-footer -->
	</div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#t_doc_receive').DataTable({
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ url('/user/list') }}"
            },
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
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
                        // button_code += '    <li><a href="<?php echo url('/document/receive/detail'); ?>">Detail_' + data + '</a></li>';
                        // button_code += '    <li><a href="<?php echo url('/document/receive/update'); ?>">Update_' + data + '</a></li>';
                        // button_code += '    <li><a href="<?php echo url('/document/receive/delete'); ?>">Delete_' + data + '</a></li>';
                        button_code += '   </ul>';
                        button_code += '</div>';
                        return button_code;
                    },
                    "className": "text-center",
                    "targets": 4
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