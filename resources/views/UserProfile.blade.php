@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>My Profile</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <!-- box Data User -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data User</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="user-event-table">
                <tbody>
                  <tr>
                    <td class="col-md-3">Nama</td>
                    <td class="col-md-9">{{$detail->name}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Alamat E-Mail</td>
                    <td class="col-md-9">{{$detail->email}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Current Access</td>
                    <td class="col-md-9">{{$role->name}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Access List</td>
                    <td class="col-md-9">
                      @foreach($role->permissions as $key => $permission)
                        <li class='list-group-item'>{{$key}}</li>
                      @endforeach
                    </td>
                  </tr>
                </tbody>
            </table>              
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
@stop