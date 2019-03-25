@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>User Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit User : {{ $user->email }}</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a href="{{ $list_url }}" class="btn btn-default btn-sm">Lihat Data</a>
                </div>
            </div>


            {!! Form::model($user, ['route' => ['users.update', $user->id],'method' => 'put']) !!}

                <div class="form-group">
                    {{ Form::label('name', 'Full Name:') }}
                    {{ Form::text('name', null, ['class'=> 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::text('email', null, ['class'=> 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password', 'Password:') }}
                    {{ Form::password('password', ['class'=> 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Password:') }}
                    {{ Form::password('password_confirmation', ['class'=> 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('roles', 'Roles:') }}
                    {{ Form::select('roles[]', $roles , null, ['class'=> 'form-control','multiple']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('kode_company', 'Company:') }}
                    {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control','required'=>'required']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Update data', ['class' => 'btn btn-success']) }}
                </div>

            {!! Form::close() !!}

        </div>

    </div>
    <!-- /.box -->
@stop
