@extends('adminlte::page')

@section('title', 'Penerimaan Detail')

@section('content_header')
<h1> Detail Penerimaan {{$penerimaan->no_penerimaan}}</h1>
@stop

@section('content')
<body onLoad="load()">
    

    <div class="box">
        <div class="box-header with-border">
            <div class="">
                <a href="{{ $list_url }}" class="btn btn-info btn-sm">List Penerimaan</a>
            </div>
            
        </div>
        <div class="box-body"> 
            <div class="row col-md-12 addform">
                    @include('errors.validation')
                    {!! Form::open(['route' => ['penerimaandetail.store'],'method' => 'post','id'=>'form1']) !!}
                        <div class="row">   
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('No Penerimaan', 'No Penerimaan:') }}
                                        {{ Form::text('no_penerimaan',$penerimaan->no_penerimaan, ['class'=> 'form-control','readonly']) }}
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
                                        {{ Form::label('qty', 'QTY:') }}
                                        {{ Form::text('qty', null, ['class'=> 'form-control','required'=>'required']) }}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('harga', 'Harga:') }}
                                        {{-- {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::text('harga',null, ['class'=> 'form-control','required'=>'required']) }}
                                    </div>
                                </div>

                            </div> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    {{ Form::submit('Add Item', ['class' => 'btn btn-success']) }}
                                    </div>
                                </div>
                            </div>
                    
                    {!! Form::close() !!}    
            </div>
            <div class="row col-md-12 editform">
                @include('errors.validation')
                {!! Form::open(['route'=>'penerimaandetail.updateajax','method' => 'post','id'=>'form2']) !!}
                            <div class="row">   
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::hidden('id',null, ['class'=> 'form-control','readonly','id'=>'ID']) }}
                                        {{ Form::label('No Penerimaan', 'No Penerimaan:') }}
                                        {{ Form::text('no_penerimaan',$penerimaan->no_penerimaan, ['class'=> 'form-control','readonly','id'=>'Penerimaan']) }}
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
                                        {{ Form::label('qty', 'QTY:') }}
                                        {{ Form::text('qty', null, ['class'=> 'form-control','id'=>'QTY','required'=>'required']) }}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('harga', 'Harga:') }}
                                        {{-- {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::text('harga',null, ['class'=> 'form-control','id'=>'Harga','required'=>'required']) }}
                                    </div>
                                </div>

                            </div> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                                    </div>
                                </div>
                            </div>
                
                {!! Form::close() !!}  
                {{-- <input type="text" id="ok">   --}}
        </div>
        
            <table class="table table-bordered table-hover" id="data-table" width="100%">
                <thead>
                <tr class="bg-purple">
                    <th>No Penerimaan</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    {{-- <th>ID</th> --}}
                    {{-- <th>Created At</th> --}}
                    {{-- <th>Updated At</th>
                    <th>Created By</th>
                    <th>Updated By</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
               
                <tbody>
                    @foreach ($penerimaandetail as $row)
                    <tr>
                        <td>{{ $row->no_penerimaan }}</td>
                        <td>{{ $row->produk->nama_produk }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ number_format($row->harga,2,",",".")}}</td>
                        <td>{{ number_format($subtotal = $row->harga * $row->qty,2,",",".")}}</td>
                        {{-- <td>{{ $row->id }}</td> --}}
                        {{-- <td>{{ $row->created_at }}</td> --}}
                        {{-- <td>{{ $row->updated_at }}</td>
                        <td>{{ $row->created_by }}</td>
                        <td>{{ $row->updated_by }}</td> --}}
                        <td>
                            <a href="javascript:;" onclick="edit('{{$row->id}}','{{$row->edit_url}}')" id="edit" class="btn btn-warning btn-sm"> 
                                <i class="fa fa-edit"></i>Edit</a>
                            &nbsp
                            <a href="javascript:;" onclick="del('{{$row->id}}','{{$row->destroy_url}}')" id="hapus" class="btn btn-danger btn-sm"> 
                                <i class="fa fa-times-circle"></i>Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                        <tr class="bg-purple">
                            <th class="text-center" colspan="2">Total</th>
                            <th>{{$total_qty}}</th>
                            <th></th>
                            <th>{{$grand_total}}</th>
                            <th></th>
                            
                        </tr>
                </tfoot>
            </table>
            {{-- <span class="row">{{$penerimaandetail->links()}}</span> --}}
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

        $(function() {
            $('#data-table').DataTable({
                scrollY: 200,
                scrollX: true
            
            });
        });

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
                        $('#Penerimaan').val(result.no_penerimaan);
                        $('#Produk').val(result.kode_produk);
                        $('#QTY').val(result.qty);
                        $('#Harga').val(result.harga);
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

    <script>
        function update(){
            var result = confirm("Want to Update?");
            if (result) {
                // console.log(id)
                $.ajax({
                    type: 'GET',
                    url: {!! route('penerimaandetail.baru') !!},
                    data: $('form2').serialize(),
                    success: function(result) {
                        console.log(result);
                        alert('Data Berhasil Di Update');
                        location.reload(true);
                    }
                });
            }
        }
    </script>
@endpush