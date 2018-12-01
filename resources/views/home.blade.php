@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Selamat Datang, <b>{{Auth::User()->name}}</b></p><br>
    <p>Anda Masuk Dengan Hak Akses Sebagai, <b>{{$role->name}}</b></p><br>
@stop