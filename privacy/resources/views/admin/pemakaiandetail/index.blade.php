@extends('adminlte::page')

@section('title', 'Pemakaian Detail')

@section('content_header')
<h1> Detail Pemakaian {{$pemakaian->no_pemakaian}}</h1>
<style>
/* #data-table tbody {

        display:block;
		height:200px;
		overflow: auto;
		width: 100%;
        float:left;
} */
/* 
#data-table tbody tr {
		display:table;
		width:100%;
} */
/* 
#data-table th td {
    width:10%;
    padding:8px;
    } */

/* 
#data-table thead {

        display:table;
		width:100%;
}

#data-table tfoot {

        display:table;
        width:100%;
} */




</style>
@stop

@section('content')
<body onLoad="load()">
    <div class="box">
        <div class="box-header with-border">
            <div class="">
                <a href="{{ $list_url }}" class="btn btn-info btn-sm">List Pemakaian</a>
                <button onclick="tablefresh()">refresh</button>
            </div>
            
        </div>
<div class="box-body"> 
<div class="row col-md-12 addform">
                    @include('errors.validation')
                    {!! Form::open(['route'=>'pemakaiandetail.store','method' => 'post','id'=>'form1']) !!}
                        <div class="row">   
                            <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('No Pemakaian', 'No Pemakaian:') }}
                                        {{ Form::hidden('id', null, ['class'=> 'form-control']) }}
                                        {{ Form::text('no_pemakaian',$pemakaian->no_pemakaian, ['class'=> 'form-control','readonly']) }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('kode_produk', 'Produk:') }}
                                        {{-- {{ Form::text('kode_produk', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::select('kode_produk',$Produk,null,
                                         ['class'=> 'form-control','required'=>'required','onchange'=>'stock();',
                                         'id'=>'kode_produk']) }}
                                    </div>
                                </div>
                    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('kode_satuan', 'Satuan:') }}
                                        {{-- {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::select('kode_satuan',$Satuan,null, ['class'=>'form-control','required'=>'required']) }}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                        <div class="form-group">
                                            {{ Form::label('qty_stock', 'Stock Tersedia:') }}
                                            {{ Form::text('qty_stock', null, ['class'=> 'form-control','readonly','id'=>'Stock']) }}
                                        </div>
                                </div>
                    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('qty', 'QTY:') }}
                                        {{ Form::number('qty', null, ['class'=>'form-control','required'=>'required','id'=>'QTY1']) }}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('harga', 'Harga:') }}
                                        {{-- {{ Form::text('kode_satuan', null, ['class'=> 'form-control']) }} --}}
                                        {{ Form::number('harga',null, ['class'=> 'form-control','required'=>'required','id'=>'HPP']) }}
                                    </div>
                                </div>

                            </div> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    {{ Form::submit('Add Item', ['class' => 'btn btn-success','id'=>'submit']) }}
                                    
                                    </div>
                                </div>
                            </div>
                    {!! Form::close() !!}
            </div>
<div class="row col-md-12 editform">
                @include('errors.validation')
                {!! Form::open(['route'=>'pemakaiandetail.updateajax','method' => 'post','id'=>'form2']) !!}
                    <div class="row">   
                        <div class="col-md-2">
                                <div class="form-group">
                                    {{ Form::label('No Pemakaian', 'No Pemakaian:') }}
                                    {{ Form::hidden('id', null, ['class'=> 'form-control','id'=>'ID']) }}
                                    {{ Form::text('no_pemakaian',$pemakaian->no_pemakaian, ['class'=> 'form-control','readonly','id'=>'Pemakaian']) }}
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
                    <th>No Pemakaian</th>
                    <th>Produk</th>
                    <th>Satuan</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    {{-- <th>Created At</th> --}}
                    {{-- <th>Updated At</th>
                    <th>Created By</th>
                    <th>Updated By</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
               
                <tbody>
                    @foreach ($Pemakaiandetail as $row)
                    <tr>
                        <td>{{ $row->no_pemakaian }}</td>
                        <td>{{ $row->produk->nama_produk }}</td>
                        <td>{{ $row->satuan->nama_satuan }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>Rp {{ number_format($row->harga,0,",",".")}}</td>
                        <td>Rp {{ number_format($subtotal = $row->harga * $row->qty,0,",",".")}}</td>
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
                        <th class="text-center" colspan="3">Total</th>
                        <th>{{$total_qty}}</th>
                        <th></th>
                        <th>Rp {{$grand_total}}</th>
                        <th></th>
                    </tr>
                </tfoot>
</table>
            {{-- <span class="row">{{$Pemakaiandetail->links()}}</span> --}}
        </div>
    </div>
</body>
@stop

@push('css')

@endpush
@push('js')
  
    <script>

        var table=$('#data-table').DataTable({
                scrollY: 200,
                scrollX: true
            
            });
        function load(){
            $('.editform').hide();
        }

        // $(function() {
        //     window.table = $('#data-table').DataTable({
        //         scrollY: 200,
        //         scrollX: true
            
        //     });
        // });
        function tablefresh(){
                window.table.draw();
            } 
        function stock(){
            var kode_produk= $('#kode_produk').val();
            var submit = document.getElementById("submit");
            $.ajax({
                url:'{!! route('pemakaiandetail.stockproduk') !!}',
                type:'POST',
                data : {
                        'id': kode_produk
                    },
                success: function(result) {
                        console.log(result);
                        if(result.stock == 0){
                            submit.disabled = true;
                        }else{
                            submit.disabled = false;
                        }
                        $('#Stock').val(result.stock);
                        $('#HPP').val(result.hpp);
                    },
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
          $('#data-table').DataTable().ajax.reload(null,false);
            // table.draw();
        }

        jQuery('#QTY1').on('change', function() {
            // do your stuff
            var stock = $('#Stock').val();
            var qty = $('#QTY1').val();
            var submit = document.getElementById("submit");
            // Check if qty more than stock
            if (qty > stock) {
                // alert('QTY Melebihi Stok Yang Tersedia');
                submit.disabled = true;
                // return false;
            }else{
                submit.disabled = false;
            }
        });
               
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
                        $('#Pemakaian').val(result.no_pemakaian);
                        $('#Produk').val(result.kode_produk);
                        $('#Satuan').val(result.kode_satuan);
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
                        // tablefresh();
                        // table.draw();
                    }
                });
            }

        }
    </script>

@endpush