@extends('adminlte::page')

@section('title', 'Bukti Pengiriman')


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
        <h4><strong>BUKTI PENGIRIMAN</strong></h4>
      </div>
      <div class="col-xs-6">
        <address>
          <strong>Kepada Yth, {{$header->send_to}}</strong><br>
          {{$header->send_to_address}}<br>
          Phone: {{$header->send_to_phone}}<br>
          Email: {{$header->send_to_email}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-xs-6 text-right">
        No. Surat: <b>{{$header->letter_number}}</b><br>
        <b>Surabaya, {{date('d M Y', strtotime($header->created_at))}}</b>
        <br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    Dengan ini,<br> Kami telah mengirimkan dokumen kepada <b>{{$header->send_to}}</b> ditempat, dengan rincian sebagai berikut:
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
      <div class="col-xs-4 text-center">
        Pengirim,
        <br><br><br><br><b>{{$header->requested_by}}
        </b>
        <br>Staff H.R. Consulting
      </div>
      <div class="col-xs-4 text-center">
        Diserahkan,
        <br><br><br><br><b>{{$header->submitted_to}}
        </b>
        <br>Receptionist H.R. Consulting
      </div>
      <div class="col-xs-4 text-center">
        Diterima,
        <br><br><br><br><b>{{$header->send_to}}
        </b>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
@stop