@extends('adminlte::page')

@section('title', 'Memo Detail')

@section('content_header')
<h1> Detail Memo {{$memo->no_memo}}</h1>
@stop

@section('content')
<body onLoad="load()">
    

    <div class="box">
        <div class="box-header with-border">
            <div class="">
                <a href="{{ $list_url }}" class="btn btn-info btn-sm">List Memo</a>
            </div>
            
        </div>
        <div class="box-body"> 
            <div class="row col-md-12 addform">
                    @include('errors.validation')
                    {!! Form::open(['route' => ['memodetail.store',$memo->no_memo],'method' => 'post','id'=>'form']) !!}
                        <div class="row">   
                            <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('No Memo', 'No Memo:') }}
                                        {{ Form::text('no_memo',$memo->no_memo, ['class'=> 'form-control','readonly']) }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('kode_produk', 'Produk:') }}
                                        {{-- {{ Form::text('kode_produk', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::select('kode_produk',$Produk,null, ['class'=> 'form-control','required'=>'required']) }}
                                    </div>
                                </div>
                    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('kode_satuan', 'Satuan:') }}
                                        {{-- {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::select('kode_satuan',$Satuan,null, ['class'=> 'form-control','required'=>'required']) }}
                                    </div>
                                </div>
                    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('qty', 'QTY:') }}
                                        {{ Form::text('qty', null, ['class'=> 'form-control','required'=>'required']) }}
                                    </div>
                                </div>

                            </div> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    {{ Form::submit('Create data', ['class' => 'btn btn-success']) }}
                                    </div>
                                </div>
                            </div>
                    
                    {!! Form::close() !!}    
            </div>
            <div class="row col-md-12 editform">
                @include('errors.validation')
                {!! Form::open(['route'=>'memodetail.updateajax','method' => 'post','id'=>'form2']) !!}
                    <div class="row">   
                        <div class="col-md-2">
                                <div class="form-group">
                                    {{ Form::label('No Memo', 'No Memo:') }}
                                    {{ Form::hidden('id', null, ['class'=> 'form-control','id'=>'ID']) }}
                                    {{ Form::text('no_memo',$memo->no_memo, ['class'=> 'form-control','readonly','id'=>'Memo']) }}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{ Form::label('kode_produk', 'Produk:') }}
                                    {{-- {{ Form::text('kode_produk', null, ['class'=> 'form-control']) }} --}}
                                    {{ Form::select('kode_produk',$Produk,null, ['class'=> 'form-control','id'=>'Produk','required'=>'required']) }}
                                </div>
                            </div>
                
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{ Form::label('kode_satuan', 'Satuan:') }}
                                    {{-- {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }} --}}
                                    {{ Form::select('kode_satuan',$Satuan,null, ['class'=> 'form-control','id'=>'Satuan','required'=>'required']) }}
                                </div>
                            </div>
                
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{ Form::label('qty', 'QTY:') }}
                                    {{ Form::text('qty', null, ['class'=> 'form-control','id'=>'QTY','required'=>'required']) }}
                                </div>
                            </div>

                    </div> 
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                {{ Form::submit('Update data', ['class' => 'btn btn-success']) }}
                                </div>
                            </div>
                        </div>
                
                {!! Form::close() !!}  
                {{-- <input type="text" id="ok">   --}}
        </div>
            <table class="table table-bordered table-hover" id="data-table" width="100%">
                <thead>
                <tr class="bg-info">
                    <th>No Memo</th>
                    <th>Produk</th>
                    <th>Satuan</th>
                    <th>Qty</th>
                    <th>Created At</th>
                    {{-- <th>Updated At</th>
                    <th>Created By</th>
                    <th>Updated By</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
               
                <tbody>
                    @foreach ($memodetail as $row)
                    <tr>
                        <td>{{ $row->no_memo }}</td>
                        <td>{{ $row->produk->nama_produk }}</td>
                        <td>{{ $row->satuan->nama_satuan }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ $row->created_at }}</td>
                        {{-- <td>{{ $row->updated_at }}</td>
                        <td>{{ $row->created_by }}</td>
                        <td>{{ $row->updated_by }}</td> --}}
                        <td>
                            <a href="javascript:;" onclick="edit('{{$row->id}}','{{$row->edit_url}}')" id="edit" class="btn btn-warning btn-sm"> 
                                <i class="fa fa-times-circle"></i>Edit</a>
                            &nbsp
                            <a href="javascript:;" onclick="del('{{$row->id}}','{{$row->destroy_url}}')" id="hapus" class="btn btn-danger btn-sm"> 
                                <i class="fa fa-times-circle"></i>Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span class="row">{{$memodetail->links()}}</span>
        </div>
    </div>
</body>
@stop

@push('css')

@endpush
@push('js')
  
    <script>

        function load(){
            $('.editform').hide();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
             $('#data-table').DataTable().ajax.reload(null,false);;
        }

               
        function edit(id, url) {
            var result = confirm("Want to Edit?");
            if (result) {
                // console.log(id)
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        console.log(result);
                        $('#ID').val(result.id);
                        $('#Memo').val(result.no_memo);
                        $('#Produk').val(result.kode_produk);
                        $('#Satuan').val(result.kode_satuan);
                        $('#QTY').val(result.qty);
                        $(".addform").hide();
                        $(".editform").show();
                    
                    }
                });
            }

        }

        function del(id, url) {
            var result = confirm("Want to delete?");
            if (result) {
                // console.log(id)
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(result) {
                        console.log(result);
                        location.reload(true);
                        $.notify(result.message, "success");
                    }
                });
            }

        }
    </script>

@endpush