@extends('adminlte::page')

@section('title', 'Produk Create')

@section('content_header')
    <h1>Produk</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Produk</h3>
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
            {!! Form::open(['route' => ['produk.store'],'method' => 'post','id'=>'form']) !!}
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
                                {{ Form::label('kode_kategori', 'Kategori:') }}
                                {{ Form::select('kode_kategori',$Kategori,null, ['class'=> 'form-control']) }}
                                    {{-- <select name="kode_kategori" id="kode_kategori" class="form-control">
                                                @foreach($Kategori as $Kategori)
                                                    <option value="{{ $Kategori->kode_kategori }}">
                                                        {{ $Kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                    </select> --}}
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_merek', 'Merek:') }}
                                {{ Form::select('kode_merek', $Merek, null, ['class'=> 'form-control']) }}
                                {{-- <select name="kode_merek" id="kode_merek" class="form-control">
                                    @foreach($Merek as $Merek)
                                        <option value="{{ $Merek->kode_merek }}">
                                            {{ $Merek->nama_merek }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_ukuran', 'Ukuran:') }}
                                {{ Form::select('kode_ukuran', $Ukuran, null, ['class'=> 'form-control']) }}
                                {{-- <select name="kode_ukuran" id="kode_ukuran" class="form-control">
                                    @foreach($Ukuran as $Ukuran)
                                        <option value="{{ $Ukuran->kode_ukuran }}">
                                            {{ $Ukuran->nama_ukuran }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_satuan', 'Satuan:') }}
                                {{ Form::select('kode_satuan', $Satuan, null, ['class'=> 'form-control']) }}
                                {{-- <select name="kode_satuan" id="kode_satuan" class="form-control">
                                    @foreach($Satuan as $Satuan)
                                        <option value="{{ $Satuan->kode_satuan }}">
                                            {{ $Satuan->nama_satuan }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode_company', 'Company:') }}
                                {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
                                {{-- <select name="kode_satuan" id="kode_satuan" class="form-control">
                                    @foreach($Satuan as $Satuan)
                                        <option value="{{ $Satuan->kode_satuan }}">
                                            {{ $Satuan->nama_satuan }}
                                        </option>
                                    @endforeach
                                </select> --}}
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


//   $("[name='status']").bootstrapSwitch({
//   on: 'Aktif',
//   off: 'NonAktif',
//   onLabel: '&nbsp;&nbsp;&nbsp;',
//   offLabel: '&nbsp;&nbsp;&nbsp;',
// //   same: false,//same labels for on/off states
//   state: true,
//   size: 'md',
//   onClass: 'primary',
//   offClass: 'danger'
// });

// var s = $('#status').val();
// $("#status").change(function(){
//     if(this.checked == true)
//     {
//         s = '1';
//     }
//     else
//     {
//         s = '0';        
//     }
//     //alert(s);
//     let status = $('#status');
//     status.val(s);
//     console.log(status);
// });
</script>

@endpush