@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Transaksi</h3>
        </div>
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Transaksi</a>
                    <div class="pull-right">
                    <a href="{{ route('transaksis.laporanExcel') }}" class="btn btn-success btn-sm">Export to Excel</a>
                    <a href="{{ route('transaksis.laporanPDF') }}" class="btn btn-danger btn-sm">Export to PDF</a>
                    </div>
                </div>
            </div>
             <table class="table table-bordered" id="customer-table">
                <thead>
                <tr>
                    <th width="20px" align="center">Tanggal Masuk</th>
                    <th width="20px" align="center">No Transaksi</th>
                    <th width="20px" align="center">No PO/DO</th>
                    <th width="20px" align="center">No Polisi</th>
                    <th width="10px" align="center">No Container</th>
                    <th width="20px" align="center">No Seal</th>
                    <th width="20px" align="center">Muatan</th>
                    <th width="20px" align="center">Nama Customer</th>
                   {{--  <th>Nama Supir</th> --}}
                    {{-- <th>Nama Barang</th>
                    <th>Nama Supplier</th>
                    <th>Nama Customer</th>
                    <th>Nama Company</th>
                    <th>Keterangan</th>
                    <th>jam_masuk</th>
                    <th>berat1</th>
                    <th>berat2</th>
                    <th>Created At</th>
                    <th>Updated At</th> --}}
                    <th width="100px" align="center">Action</th>
                 </tr>
                </thead>
            </table>

        </div>
    </div>
@stop

@push('css')

@endpush
@push('js')
  
    <script>
        $(function() {
            $('#customer-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('transaksi.data') !!}',
            order: [[ 0, "desc" ]],
            columns: [
                { data: 'tanggal_masuk', name: 'tanggal_masuk'},
                { data: 'no_transaksi', name: 'no_transaksi' },
                { data: 'no_po', name: 'no_po' },
                { data: 'no_polisi', name: 'no_polisi' },
                { data: 'no_container', name: 'no_container' },
                { data: 'no_seal', name: 'no_seal' },
                { data: 'muatan', name: 'muatan' },
                //{ data: 'nama_supir', name: 'nama_supir' },
                //{ data: 'supplier.nama_supplier', name: 'supplier.nama_supplier' },
                { data: 'customer.nama_customer', name: 'customer.nama_customer' },
                //{ data: 'company.nama_company', name: 'company.nama_company'},
                //{ data: 'barang.nama_barang', name: 'barang.nama_barang' },
                //{ data: 'keterangan', name: 'keterangan' },
                //{ data: 'jam_masuk', name: 'jam_masuk' },
                //{ data: 'berat1', name: 'berat1' },
                //{ data: 'berat2', name: 'berat2' },
                //{ data: 'created_at', name: 'created_at' },
                //{ data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action' }
            ]
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function refreshTable() {
             $('#customer-table').DataTable().ajax.reload(null,false);;
        }
        function del(id, url) {
            var result = confirm("Want to delete?");
            if (result) {
                // console.log(id)
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(result) {
                        console.log(result);
                        $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            }

        }
    </script>
@endpush