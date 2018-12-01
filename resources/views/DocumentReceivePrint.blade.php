@extends('adminlte::page')

@section('title', 'Bukti Tanda Terima')


@section('content')
<!-- <body onload="window.print();"> -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <img src="{{asset('public/img/full_logo.jpg')}}" style="width:400px; height: 100px;">
          <!-- <i class="fa fa-globe"></i> H.R. CONSULTING -->
          <small class="pull-right">Tanggal Cetak: {{date('d M Y', strtotime(now()))}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-xs-12">
        <h4><strong>BUKTI TANDA TERIMA</strong></h4>
      </div>
      <div class="col-xs-4">
        <address>
          <strong>Diterima Dari, {{$header->client_name}}</strong><br>
          {{$header->client_address}}<br>
          Phone: {{$header->client_phone}}<br>
          Email: {{$header->client_email}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <address>
          <strong>Ditujukan Kepada, {{$header->r2_name}}</strong><br>
          Selaku Staff H.R. Consulting, <br>Ditempat.<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-xs-4 text-right">
        No. Surat: <b>{{$header->letter_number}}</b><br>
        <b>Surabaya, {{date('d M Y', strtotime($header->created_at))}}</b>
        <br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <br>Dengan ini menyatakan,<br>Bahwa saya <b>{{$header->r1_name}}</b> selaku Receptionist H.R. Consulting, telah menerima dokumen dari klien <b>{{$header->client_name}}</b> dengan rincian sebagai berikut:
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Rincian</th>
          </tr>
          </thead>
          <tbody>
          @php ($i = 1)
          @foreach($detail as $detail_data)
          <tr>
            <td>{{$i}}</td>
            <td>{{$detail_data->description}}</td>
          </tr>
          @php ($i += 1)
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Signatures row -->
    <div class="row">
      <div class="col-xs-6 text-center">
        Penerima I
        <br><br><br><br><b>{{$header->r1_name}}</b>
      </div>
      <div class="col-xs-6 text-center">
        
        Penerima II
        <br><br><br><br><b>{{$header->r2_name}}</b>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
@stop