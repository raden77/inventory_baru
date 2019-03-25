@extends('adminlte::page')

@section('title', $info['title'])

@section('content_header')
    <h1>{{ $info['title'] }}</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $info['title'] }}</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a href="{{ $info['list_url'] }}" class="btn btn-default btn-sm">Lihat Data</a>
                    <a href="{{ $permission->edit_url }}" class="btn btn-warning btn-sm pull-right"><i class="fa fa-edit"></i> Edit Data</a>
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $permission->name }}</td>
                </tr>
                <tr>
                    <th>Display Name</th>
                    <td>{{ $permission->display_name }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $permission->description }}</td>
                </tr>
            </table>
        </div>

    </div>
    <!-- /.box -->
@stop
