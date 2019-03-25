@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Merek Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Merek : {{ $Merek->nama_merek }}</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="{{ $list_url }}" class="btn btn-default btn-sm">Lihat Data</a>  
        </div>
    </div>
        <div class="box box-success">
            <div class="box-body">
            @include('errors.validation')
            {!! Form::model($Merek, ['route' => ['merek.update', $Merek->kode_merek],'method' => 'patch']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode merek', 'Kode Merek:') }}
                                {{ Form::text('kode_merek', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('nama merek', 'Nama Merek:') }}
                                {{ Form::text('nama_merek', null, ['class'=> 'form-control',]) }}
                            </div>
                        </div>
                </div>
             
                <div class="box-footer">
                        <div class="row pull-right">
                            <div class="col-md-12">
                                    {{ Form::submit('Update data', ['class' => 'btn btn-success']) }}
                             </div>
                        </div>
                </div>
            {!! Form::close() !!}
    </div>

    </div>
</div>
<!-- /.box -->
@stop
