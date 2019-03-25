@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Memo Edit</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Produk : {{ $memo->no_memo }}</h3>
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
            {!! Form::model($memo, ['route' => ['memo.update', $memo->no_memo],'method' => 'patch']) !!}
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('No memo', 'No Memo:') }}
                            {{ Form::text('no_memo', null, ['class'=> 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('no_permintaan', 'No Permintaan:') }}
                            {{-- {{ Form::text('no_permintaan', null, ['class'=> 'form-control']) }} --}}
                            {{ Form::select('no_permintaan', $Permintaan, null, ['class'=> 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('Tanggal memo', 'Tanggal memo:') }}
                            {{ Form::date('tanggal_memo', null,['class'=> 'form-control'])}}
                            {{-- {{ Form::text('tanggal_memo', null, ['class'=> 'form-control']) }} --}}
                        </div>
                    </div>

                    <div class="col-md-2">
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