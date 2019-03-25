@extends('adminlte::page')

@section('title', 'Users Data')

@section('content_header')
    <h1>User Data</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Manages User</h3>
        </div>
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a href="{{ $create_url }}" class="btn btn-info btn-sm">Create New Permission</a>
                </div>
            </div>
            <table class="table">
{{--                {{ dd($permissions->toArray()) }}--}}
                @foreach($permissions->groupBy('tab') as $key => $value)
                    <thead>
                    <tr>
                        <th colspan="3"><i class="fa fa-arrow-right"></i> {{ $key }}</th>
                    </tr>
                    <tr>
                        <th style="padding-left: 30px">Name (<i>System Only</i>)</th>
                        <th style="padding-left: 30px">Display Name (<i>User frendly</i>)</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($value as $row)
                        <tr>
                            <td style="padding-left: 40px">{{ $row->name }}</td>
                            <td style="padding-left: 40px">{{ $row->display_name }}</td>
                            <td>{{ $row->description }}</td>
                            <td>
                                <a href="{{ $row->show_url }}" class="btn btn-primary btn-sm">Show</a>
                                <a href="{{ $row->edit_url }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@stop


@push('js')


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