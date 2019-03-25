@extends('adminlte::page')

@section('title', 'Permintaan Create')

@section('content_header')
    <h1>Permintaan</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Permintaan</h3>
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
            {!! Form::open(['route' => ['permintaan.store'],'method' => 'post','id'=>'form']) !!}
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
                                {{ Form::date('tanggal_permintaan', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('Type', 'Type:') }}
                                {{ Form::select('type', ['Umum' => 'Umum', 'Mobil' => 'Mobil','Alat' => 'Alat',
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