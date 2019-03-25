@extends('adminlte::page')

@section('title', 'Penerimaan Create')

@section('content_header')
    <h1>Penerimaan</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Penerimaan</h3>
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
            {!! Form::open(['route' => ['penerimaan.store'],'method' => 'post','id'=>'form']) !!}
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
                                {{ Form::date('tanggal_penerimaan', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                {{-- {{ Form::text('tanggal_penerimaan', null, ['class'=> 'form-control']) }} --}}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('status', 'Status:') }}
                                {{ Form::text('status', null, ['class'=> 'form-control']) }}
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