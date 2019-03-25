@extends('adminlte::page')

@section('title', $info['title'])

@section('content_header')
    <h1>User Edit</h1>
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
                </div>
            </div>
            @include('errors.validation')

            {!! Form::model($permission, ['route' => ['permissions.update', $permission->id],'method' => 'put']) !!}

                <div class="form-group">
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', null, ['class'=> 'form-control','readonly']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('display_name', 'Display Name:') }}
                    {{ Form::text('display_name', null, ['class'=> 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Description:') }}
                    {{ Form::text('description', null, ['class'=> 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Update data', ['class' => 'btn btn-success']) }}
                </div>

            {!! Form::close() !!}

        </div>

    </div>
    <!-- /.box -->
@stop
