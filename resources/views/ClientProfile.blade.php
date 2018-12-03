@extends('adminlte::page')

@section('title', 'Client Profile')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Client Profile</h1>
@stop

@section('content')
<!-- /.col -->
<div class="col-md-12">
    <!-- box Data Client -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data Client</strong>
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
                    <td class="col-md-9">{{$client_data->name}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Alamat</td>
                    <td class="col-md-9">{{$client_data->address}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">Telp.</td>
                    <td class="col-md-9">{{$client_data->phone}}</td>
                  </tr>
                  <tr>
                    <td class="col-md-3">E-mail</td>
                    <td class="col-md-9">{{$client_data->email}}</td>
                  </tr>
                </tbody>
            </table>              
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- box Data Staff -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Ditangani Oleh:</strong>
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
                  <thead>
                    <tr>
                      <th class="col-md-1">Staff ID</th>
                      <th class="col-md-5">Nama</th>
                      <th class="col-md-4">Alamat E-mail</th>
                      <th class="col-md-2">Access</th>
                    </tr>
                  </thead>
                  @foreach($client_data->staffs as $staff)
                  <tr>
                    <td>#{{$staff->id}}</td>
                    <td>{{$staff->name}}</td>
                    <td>{{$staff->email}}</td>
                    <td>{{$staff->role}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>              
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <a type="submit" class="btn btn-danger btn-sm pull-right btn-flat" style="margin-right: 5px;" href="{{ url('/client') }}">Kembali</a>
        </div>
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
@stop