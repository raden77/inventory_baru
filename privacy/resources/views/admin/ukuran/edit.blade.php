@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Ukuran Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Ukuran : {{ $Ukuran->nama_ukuran }}</h3>
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
            {!! Form::model($Ukuran, ['route' => ['ukuran.update', $Ukuran->kode_ukuran],'method' => 'patch']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode ukuran', 'Kode Ukuran:') }}
                                {{ Form::text('kode_ukuran', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('nama ukuran', 'Nama Ukuran:') }}
                                {{ Form::text('nama_ukuran', null, ['class'=> 'form-control',]) }}
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
