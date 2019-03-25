@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Produk Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Produk : {{ $produk->nama_produk }}</h3>
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
            {!! Form::model($produk, ['route' => ['produk.update', $produk->kode_produk],'method' => 'patch']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode Produk', 'Kode Produk:') }}
                                {{ Form::text('kode_produk', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('Nama Produk', 'Nama Produk:') }}
                                {{ Form::text('nama_produk', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_kategori', 'Kode Kategori:') }}
                                {{ Form::select('kode_kategori',$Kategori,null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_merek', 'Kode Merek:') }}
                                {{ Form::select('kode_merek', $Merek,null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_ukuran', 'Kode Ukuran:') }}
                                {{ Form::select('kode_ukuran', $Ukuran,null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_satuan', 'Kode Satuan:') }}
                                {{ Form::select('kode_satuan', $Satuan,null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_company', 'Company:') }}
                                {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('type', 'Type:') }}
                                {{ Form::text('type', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('harga_beli', 'Harga Beli:') }}
                                {{ Form::text('harga_beli', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('harga_jual', 'Harga Jual:') }}
                                {{ Form::text('harga_jual', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('hpp', 'HPP:') }}
                                {{ Form::text('hpp', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('stok', 'Stok:') }}
                                {{ Form::text('stok', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('aktif', 'Aktif:') }}
                                {{ Form::text('aktif', null, ['class'=> 'form-control']) }}
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