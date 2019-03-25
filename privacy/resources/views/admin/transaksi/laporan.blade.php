@extends('adminlte::page')

@section('title', 'Laporan Transaksi  Per Periode')

@section('content_header')
    <h1>Laporan Transaksi</h1>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

@section('content')
<body>
    

<div class="col-md-12">
    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> Laporan Transaksi Per Periode</h3>
                <!-- /.box-tools -->
            </div>
           {{--  <!-- /.box-header -->
            <div class="box-body">
                    
            </div> --}}
    </div>
</div>
<div class="col-md-4"> 
    
</div>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-body">
            {!! Form::open(['route' => ['transaksis.cetakLaporan'],'method' => 'post','id'=>'form']) !!}
                    <div class="row">
                     <div class="col-md-2 col-md-offset-4">
                        <div class="form-group">
                            {{ Form::label('name', 'Start Date') }}
                            {{ Form::text('start_date', null, ['class'=> 'form-control datepicker']) }}<br>
                        </div>
                    </div>
                     </div>
                    <div class="row">
                     <div class="col-md-2 col-md-offset-4">
                        <div class="form-group">
                            {{ Form::label('name', 'End Date') }}
                            {{ Form::text('end_date', null, ['class'=> 'form-control datepicker']) }}<br>
                        </div>
                     </div>
                
        </div>
            <div class="box-footer">
                <div class="pull-right">
                        {{ Form::submit('Cetak Laporan', ['class' => 'btn btn-success']) }}
                </div>
            </div>

            {!! Form::close() !!}
    </div>
</div>    
        

    
</body>
    <!-- /.box -->
@stop

@push('js')

 {{--  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script> --}}
  {{-- <script src="{{ asset('js/bootstrap.datepicker.js') }}"></script> --}}
  <script>
  $(function() {
    $( ".datepicker" ).datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoClose: true,
        icon:{
          time:"fa fa-clock-o",
          date:"fa fa-calender",
          up:"fa fa-arrow-up",
          down:"fa fa-arrow-down"
          }
        });
  });
  </script>

 <script>
        
</script>

@endpush
