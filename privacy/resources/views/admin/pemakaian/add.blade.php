@extends('adminlte::page')

@section('title', 'Pemakaian Create')

@section('content_header')
    
@stop

@section('content')
<body onload="load()">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Pemakaian</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="{{ $list_url }}" class="btn btn-default btn-sm">Lihat Data</a>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-body">
                    <div class="row form-header">
                        @include('errors.validation')
                        {{-- {!! Form::open(['route' => ['pemakaian.store'],'method' => 'post','id'=>'form','role'=>'form']) !!} --}}
                        {!! Form::open(['id'=>'Addform']) !!}
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{ Form::label('Type', 'Tipe Pemakaian:',['class'=>'control-label']) }}
                                    {{ Form::select('type', ['Mobil' => 'Mobil','Alat' => 'Alat',
                                'Jasa' => 'Jasa'], null, ['class'=> 'form-control'])}}
                                </div>
                            </div>
    
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('Tanggal Pemakaian', 'Tanggal Pemakaian:') }}
                                    {{ Form::date('tanggal_pemakaian', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                    {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Deskripsi', 'Deskripsi:') }}
                                    {{ Form::textArea('deskripsi', null, ['class'=> 'form-control','rows'=>'4']) }}
                                </div>
                            </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="pull-right">{{ Form::submit('Create Pemakaian', ['class' => 'btn btn-success','id'=>'addsubmit']) }}</div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <hr>
                    <div class="row form-detail">
                        @include('errors.validation')
                        {!! Form::open(['route' => ['pemakaiandetail.multistore'],'method' => 'post','id'=>'form-detail-p','role'=>'form']) !!}
                        <div class="col-md-12">
                            <button id="btnAddRow" type="button" class="btn btn-default btn-sm">
                                    <i class="fa fa-plus"></i> Add Item</button>
                            <button id="btnDelLastRow" type="button" class="btn btn-default btn-sm"> 
                                    <i class="fa fa-close"></i> Delete Last Item</button>
                            <button id="btnDelCheckRow" type="button" class="btn btn-default btn-sm">
                                    <i class="fa fa-close"></i> Delete Checked Item</button>
                            
                            <table class="table table-striped table-bordered" id="tblAddRow">
                                    <thead>
                                        <tr class="bg-green"">
                                            <th><input type="checkbox" id="checkedAll"/></th>
                                            <th>No Pemakaian</th>
                                            <th>Produk</th>
                                            <th>Satuan</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input name="ckcDel[]" type="checkbox" /></td>
                                            <td>
                                                {{ Form::text('no_pemakaian[]',null, ['class'=> 'form-control','readonly','id'=>'Pemakaian']) }}
                                            </td>
                                            <td>
                                                {{ Form::select('kode_produk[]',$produk,null, ['class'=> 'form-control','id'=>'Produk','required'=>'required']) }}
                                            </td>
                                            <td>
                                                {{ Form::select('kode_satuan[]',$satuan,null, ['class'=> 'form-control','id'=>'Satuan','required'=>'required']) }}
                                            </td>
                                            <td>
                                                {{ Form::number('qty[]', null, ['class'=>'form-control','required'=>'required','id'=>'QTY1']) }}
                                            </td>
                                            <td>
                                                {{ Form::number('harga[]',null, ['class'=> 'form-control','required'=>'required','id'=>'HPP']) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
            
    </div> 
                            <div class="box-footer form-detail">
                                    <div class="pull-right">
                                    {{ Form::submit('Finish', ['class' => 'btn btn-success']) }}
                                    </div>
                            </div>
                            {!! Form::close() !!}
        
        </div>

    </div>
    <!-- /.box -->
</body>
@stop
@push('js')
<script>
// Add button Delete in row
$('tbody tr')
    .find('td')
    //.append('<input type="button" value="Delete" class="del"/>')
    .parent() //traversing to 'tr' Element
    .append('<td><a href="#" class="delrow btn btn-danger btn-sm"><i class="fa fa-close"></i> Delete</a></td>');

// For select all checkbox in table
$('#checkedAll').click(function (e) {
	//e.preventDefault();
    $(this).closest('#tblAddRow').find('td input:checkbox').prop('checked', this.checked);
});

// Add row the table
$('#btnAddRow').on('click', function() {
    var lastRow = $('#tblAddRow tbody tr:last').html();
    var no_pemakaian = $('#Pemakaian').val();
    //alert(lastRow);
    $('#tblAddRow tbody').append('<tr>' + lastRow + '</tr>');
    
    // $('#tblAddRow tbody tr:last input').val('');
});

// Delete last row in the table
$('#btnDelLastRow').on('click', function() {
    var lenRow = $('#tblAddRow tbody tr').length;
    //alert(lenRow);
    if (lenRow == 1 || lenRow <= 1) {
        alert("Can't remove all row!");
    } else {
        $('#tblAddRow tbody tr:last').remove();
    }
});

// Delete row on click in the table
$('#tblAddRow').on('click', 'tr a', function(e) {
    var lenRow = $('#tblAddRow tbody tr').length;
    e.preventDefault();
    if (lenRow == 1 || lenRow <= 1) {
        alert("Can't remove all row!");
    } else {
        $(this).parents('tr').remove();
    }
});

// Delete selected checkbox in the table
$('#btnDelCheckRow').click(function() {
	var lenRow		= $('#tblAddRow tbody tr').length;
    var lenChecked	= $("#tblAddRow input[type='checkbox']:checked").length;
    var row	= $("#tblAddRow tbody input[type='checkbox']:checked").parent().parent();
    //alert(lenRow + ' - ' + lenChecked);
    if (lenRow == 1 || lenRow <= 1 || lenChecked >= lenRow) {
        alert("Can't remove all row!");
    } else {
        row.remove();
    }
});


</script>
<script>

// function load(){
//     $('.form-detail').hide();
// }

$('#Addform').submit(function (e) {
            e.preventDefault();
            
            var registerForm = $("#Addform");
            var formData = registerForm.serialize();
            var addsubmit = document.getElementById("addsubmit");
                $.ajax({
                    url:'{!! route('pemakaian.addstore') !!}',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#Pemakaian').val(data.no_pemakaian);
                        $(".form-detail").show();
                        addsubmit.disabled = true;
                    },
                });
        });
</script>

@endpush