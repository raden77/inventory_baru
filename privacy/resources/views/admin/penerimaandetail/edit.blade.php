@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Penerimaan Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Produk : {{ $penerimaan->no_penerimaan }}</h3>
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
            {!! Form::model($penerimaan, ['route' => ['penerimaan.update', $penerimaan->no_penerimaan],'method' => 'patch']) !!}
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('No Penerimaan', 'No Penerimaan:') }}
                                    {{ Form::text('no_penerimaan', null, ['class'=> 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('No Pembelian', 'No Pembelian:') }}
                                    {{ Form::text('no_pembelian', null, ['class'=> 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Tanggal Penerimaan', 'Tanggal Penerimaan:') }}
                                    {{ Form::text('tanggal_penerimaan', null, ['class'=> 'form-control']) }}
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