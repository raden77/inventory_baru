@extends('adminlte::page')

@section('title', 'Satuan Create')

@section('content_header')
    <h1>Satuan</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Satuan</h3>
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
            {!! Form::open(['route' => ['satuan.store'],'method' => 'post','id'=>'form']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode satuan', 'Kode Satuan:') }}
                                {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('nama_satuan', 'Nama Satuan:') }}
                                {{ Form::text('nama_satuan', null, ['class'=> 'form-control',]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('status', 'Status:') }} <br>
                                {{Form::select('status', ['1' => 'Aktif', '0' => 'Non Aktif'], '1', ['class'=> 'form-control'])}}
                            </div>
                        </div>
        </div>
        <div class=" box-footer">
                    <div class="pull-right">
                    {{ Form::submit('Create data', ['class' => 'btn btn-success']) }}
                    </div>
        </div>

        {!! Form::close() !!}
        </div>

    </div>
    <!-- /.box -->
@stop
@push('js')
<script>
  
</script>

@endpush
