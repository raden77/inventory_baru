@extends('adminlte::page')

@section('title', 'Manages Role')

@section('content_header')
    <h1>Manages Role   </h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data Roles</h3>
        </div>
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a href="{{ $create_url }}" class="btn btn-info btn-sm">New role</a>
                    {{--<a href="" class="btn btn-default btn-sm">Manages Role</a>--}}
                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="refreshTable()">Refresh Data</a>
                </div>
            </div>
            {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
             $('#dataTableBuilder').DataTable().ajax.reload();;
        }
        function del(id, url) {
            var result = confirm("Do you want to delete?");
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