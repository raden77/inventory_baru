@extends('adminlte::page')

@section('title', 'Show Data')

@section('content_header')
    <h1>Show Transaksi</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Show Data Transaksi : {{ $transaksi->no_transaksi }}</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a class="btn btn-default" href="{{ $info['list_url'] }}">Lihat Data</a>
                    <a class="btn btn-primary" href="{{ $info['edit_url'] }}">Edit Data</a>
                    <a class="btn btn-danger pull-right" href="{{ route('transaksis.pdf', $transaksi->no_transaksi) }}">Cetak</a>
                </div>
            </div>

            <table class="table table-bordered" id="customer-table">
                <thead>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{$transaksi->tanggal_masuk}}</td>
                    </tr>
                    <tr>
                        <th>No Transaksi</th>
                        <td>{{$transaksi->no_transaksi}}</td>
                    </tr>
                    <tr>
                        <th>No PO/DO</th>
                        <td>{{$transaksi->no_po}}</td>
                    </tr>
                    <tr>
                        <th>No Polisi</th>
                        <td>{{$transaksi->no_polisi}}</td>
                    </tr>
                    <tr>
                        <th>No Seal</th>
                        <td>{{$transaksi->no_seal}}</td>
                    </tr>
                    <tr>
                        <th>No Container</th>
                        <td>{{$transaksi->no_container}}</td>
                    </tr>
                    <tr>
                        <th>Tipe Container</th>
                        <td>{{$transaksi->sizetipemaster->size_type}}</td>
                    </tr>
                    <tr>
                        <th>Muatan</th>
                        <td>{{$transaksi->muatan}}</td>
                    </tr>
                    <tr>
                        <th>Nama Supir</th>
                        <td>{{$transaksi->nama_supir}}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{$transaksi->barang->nama_barang}}</td>
                    </tr>
                    <tr>
                        <th>Nama Supplier</th>
                        <td>{{$transaksi->supplier->nama_supplier}}</td>
                    </tr>
                    <tr>
                        <th>Nama Customer</th>
                        <td>{{$transaksi->customer->nama_customer}}</td>
                    </tr>
                    <tr>
                        <th>Nama Company</th>
                        <td>{{$transaksi->company->nama_company}}</td>
                    </tr>
                    <tr>
                        <th>Berat 1</th>
                        <td>{{$transaksi->berat1}}</td>
                    </tr>
                    <tr>
                        <th>Berat 2</th>
                        <td>{{$transaksi->berat2}}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{$transaksi->keterangan}}</td>
                    </tr>
                <thead>
            </table>

        </div>

    </div>
    <!-- /.box -->
@stop
