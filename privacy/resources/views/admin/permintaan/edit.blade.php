@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Permintaan Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Produk : {{ $permintaan->no_permintaan }}</h3>
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
            {!! Form::model($permintaan, ['route' => ['permintaan.update', $permintaan->no_permintaan],'method' => 'patch']) !!}
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('No Permintaan', 'No Permintaan:') }}
                            {{ Form::text('no_permintaan', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('Deskripsi', 'Deskripsi:') }}
                            {{ Form::text('deskripsi', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('Tanggal Permintaan', 'Tanggal Permintaan:') }}
                            {{ Form::date('tanggal_permintaan', null,['class'=> 'form-control'])}}
                            {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}

                        </div>
                    </div>
                
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('Type', 'Type:') }}
                            {{Form::select('type', ['Umum' => 'Umum', 'Mobil' => 'Mobil','Alat' => 'Alat',
                        'Jasa' => 'Jasa','Stok' => 'Stok'], null, ['class'=> 'form-control'])}}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('status', 'Status:') }}
                            {{ Form::text('status', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('kode_company', 'Company:') }}
                            {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
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