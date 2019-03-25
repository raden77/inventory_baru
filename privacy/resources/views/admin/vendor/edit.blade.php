@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Vendor Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Vendor : {{ $vendor->nama_vendor }}</h3>
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
            {!! Form::model($vendor, ['route' => ['vendor.update', $vendor->kode_vendor],'method' => 'patch']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode Vendor', 'Kode Vendor:') }}
                                {{ Form::text('kode_vendor', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('Nama Vendor', 'Nama Vendor:') }}
                                {{ Form::text('nama_vendor', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('alamat', 'Alamat:') }}
                                {{ Form::text('alamat', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('telp', 'Telp:') }}
                                {{ Form::text('telp', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('Hp', 'Hp:') }}
                                {{ Form::text('hp', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('Npwp', 'Npwp:') }}
                                {{ Form::text('npwp', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('termin_pembayaran', 'Termin Pembayaran:') }}
                                {{ Form::text('termin_pembayaran', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('status', 'Status:') }}<br>
                                {{Form::select('status', ['1' => 'Aktif', '0' => 'Non Aktif'], null, ['class'=> 'form-control'])}}
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