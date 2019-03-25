@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Pemakaian Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Produk : {{ $pemakaian->no_pemakaian }}</h3>
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
            {!! Form::model($pemakaian, ['route' => ['pemakaian.update', $pemakaian->no_pemakaian],'method' => 'patch']) !!}
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('No Pemakaian', 'No Pemakaian:') }}
                            {{ Form::text('no_pemakaian', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('No Pemakaian', 'No Pemakaian:') }}
                            {{ Form::text('no_permintaan', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('Tanggal Pemakaian', 'Tanggal Pemakaian:') }}
                            {{ Form::text('tanggal_pemakaian', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('status', 'Status:') }}
                            {{ Form::text('status', null, ['class'=> 'form-control']) }}
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
@push('js')

<script>

</script>

@endpush