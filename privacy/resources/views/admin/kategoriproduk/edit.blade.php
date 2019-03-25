@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Kategori Produk Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Kategori Produk : {{ $kategoriproduk->nama_kategori }}</h3>
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
            {!! Form::model($kategoriproduk, ['route' => ['kategoriproduk.update', $kategoriproduk->kode_kategori],'method' => 'patch']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode kategori', 'Kode Kategori:') }}
                                {{ Form::text('kode_kategori', null, ['class'=> 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('nama kategori', 'Nama Kategori:') }}
                                {{ Form::text('nama_kategori', null, ['class'=> 'form-control',]) }}
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