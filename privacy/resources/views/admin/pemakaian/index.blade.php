@extends('adminlte::page')

@section('title', 'Pemakaian')

@section('content_header')
    
    <style>

        td.details-control {
        background: url('../css/plus.png') no-repeat center center;
        cursor: pointer;
        }
        tr.shown td.details-control {
        background: url('../css/minus.png') no-repeat center center;
        }
 
    </style>
@stop

@section('content')
    <div class="box box-solid box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Pemakaian</h3>
        </div>
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    <a href="{{ $create_url }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> New Pemakaian</a>
                    <button type="button" class="btn btn-default btn-sm" onclick="refreshTable()" >
                        <i class="fa fa-refresh"></i> Refresh</button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addform">
                        <i class="fa fa-plus"></i> New Pemakaian</button>
                    <span class="pull-right"> 
                        <button type="button" class="btn btn-success btn-sm" id="button1"><i class="fa fa-bullhorn"></i> POST</button>
                        <button type="button" class="btn btn-warning btn-sm" id="button2"><i class="fa fa-undo"></i> UNPOST</button>
                        <button type="button" class="btn btn-info btn-sm" id="button3"><i class="fa fa-paperclip"></i> VIEW DETAIL</button>
                        {{-- <button type="button" class="btn btn-default btn-sm" id="button3"><i class="fa fa-print"></i> PRINT</button> --}}
                        <a href="#" target="_blank" class="btn btn-default btn-sm" id="button4">
                            <i class="fa fa-print"></i>PRINT
                        </a>
                    </span>
                </div>
            </div>
            <table class="table table-bordered table-hover" id="data-table" width="100%">
                <thead>
                <tr class="bg-success">
                    {{-- <th></th> --}}
                    <th>No Pemakaian</th>
                    {{-- <th>No Permintaan</th> --}}
                    <th>Tanggal Pemakaian</th>
                    <th>Status</th>
                    <th>Tipe Pemakaian</th>
                    <th>Deskripsi</th>
                    <th>Total Item</th>
                    {{-- <th>Company</th> --}}
                    <th>Created At</th>
                    {{-- <th>Updated At</th>
                    <th>Created By</th>
                    <th>Updated By</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>

      <!-- /.col -->

<div class="modal fade" id="addform"  role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Create Data</h4>
                </div>
                @include('errors.validation')
                {!! Form::open(['route' => ['pemakaian.store'],'method' => 'post','id'=>'form','role'=>'form']) !!}
                        <div class="modal-body">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('No Pemakaian', 'No Pemakaian:') }}
                                        {{ Form::text('no_pemakaian', null, ['class'=> 'form-control']) }}
                                     </div>
                                </div>  --}}

                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('No Permintaan', 'No Permintaan:') }}
                                        {{ Form::select('no_permintaan',$Permintaan,null, ['class'=> 'form-control select2','style'=>'width: 100%']) }}
                                        <select id="select2" class=" select2 form-control" name="kode_item"  style= 'width: 100%' >
                                            <option disabled selected hidden>- Pilih No Permintaan -</option>   
                                        @foreach($Permintaan2 as $row)
                                            <option value="{{ $row->no_permintaan }}">
                                                {{ $row->no_permintaan }}
                                            </option>
                                        @endforeach
                                    </div>
                                </div> --}}
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('Type', 'Tipe Pemakaian:',['class'=>'control-label']) }}
                                        {{ Form::select('type', ['Mobil' => 'Mobil','Alat' => 'Alat',
                                    'Jasa' => 'Jasa'], null, ['class'=> 'form-control'])}}
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('Tanggal Pemakaian', 'Tanggal Pemakaian:') }}
                                        {{ Form::date('tanggal_pemakaian', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                        {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('Deskripsi', 'Deskripsi:') }}
                                        {{ Form::textArea('deskripsi', null, ['class'=> 'form-control','rows'=>'4']) }}
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('kode_company', 'Company:') }}
                                        {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
                                    </div>
                                </div> --}}
        
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('status', 'Status:') }}
                                        {{ Form::text('status', null, ['class'=> 'form-control']) }}
                                    </div>
                                </div> --}}
    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                {{ Form::submit('Create data', ['class' => 'btn btn-success crud-submit']) }}
                                {{ Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal']) }}&nbsp;
                            </div>
                        </div>
                    {!! Form::close() !!}
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<div class="modal fade" id="editform" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Edit Data</h4>
                    </div>
                    @include('errors.validation')
                    {!! Form::open(['route' => ['pemakaian.updateajax'],'method' => 'post','id'=>'form']) !!}
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('No Pemakaian', 'No Pemakaian:') }}
                                            {{ Form::text('no_pemakaian', null, ['class'=> 'form-control','id'=>'Pemakaian','readonly']) }}
                                        </div>
                                    </div> 
                                    
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('No Permintaan', 'No Permintaan:') }}
                                            {{ Form::text('no_permintaan', null, ['class'=> 'form-control','id'=>'Permintaan']) }}
                                            {{ Form::select('no_permintaan',$Permintaan,null, ['class'=> 'form-control','id'=>'Permintaan']) }}
                                        </div>
                                    </div> --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{ Form::label('Type', 'Tipe Pemakaian:') }}
                                            {{ Form::select('type', ['Mobil' => 'Mobil','Alat' => 'Alat',
                                        'Jasa' => 'Jasa'], null, ['class'=> 'form-control','id'=>'Type'])}}
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('Tanggal Pemakaian', 'Tanggal Pemakaian:') }}
                                            {{ Form::date('tanggal_pemakaian', null,['class'=> 'form-control','id'=>'Tanggal'])}}
                                            {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('Deskripsi', 'Deskripsi:') }}
                                            {{ Form::textArea('deskripsi', null, ['class'=> 'form-control','rows'=>'4','id'=>'Deskripsi']) }}
                                        </div>
                                    </div>
    

                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('kode_company', 'Company:') }}
                                            {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            {{ Form::label('status', 'Status:') }}
                                            {{ Form::text('status', null, ['class'=> 'form-control','id'=>'Status']) }}
                                        </div>
                                    </div> --}}
        
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    {{ Form::submit('Update data', ['class' => 'btn btn-success crud-submit']) }}
                                    {{ Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal']) }}&nbsp;
                                </div>
                            </div>
                        {!! Form::close() !!}
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

@stop

@push('css')

@endpush
@push('js')
    
    <script>
        $(function() {
            $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('pemakaian.data') !!}',
           
            columns: [
                // {
                //     "className":'details-control',
                //     "orderable":false,
                //     "data":null,
                //     "defaultContent":''
                // },
                { data: 'no_pemakaian', name: 'no_pemakaian' },
                // { data: 'no_permintaan', name: 'no_permintaan' },
                { data: 'tanggal_pemakaian', name: 'tanggal_pemakaian' },
                { data: 'status', name: 'status' },
                { data: 'type', name: 'type' },
                { data: 'deskripsi', name: 'deskripsi' },
                { data: 'pemakaiandetail_count', name: 'pemakaiandetail_count' },
                // { data: 'company.nama_company', name: 'company.nama_company' },
                { data: 'created_at', name: 'created_at' },
                // { data: 'updated_at', name: 'updated_at' },
                // { data: 'created_by', name: 'created_by' },
                // { data: 'updated_by', name: 'updated_by' },
                { data: 'action', name: 'action' }
            ]
            });
        });

        $(function() {
            $('#child-table').DataTable({
                scrollY: 200,
                scrollX: true
            
            });
        });


        function formatRupiah(angka, prefix='Rp'){
            var	number_string = angka.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }

        function createTable(result){

        var total_qty = 0;
        var total_pakai = 0;
        var total_harga = 0;
        var grand_total = 0;

        $.each( result, function( key, row ) {
            total_qty += row.qty;
            harga = row.harga;
            qty = row.qty;
            total_pakai = harga * qty;
            total_harga += total_pakai;
            grand_total = formatRupiah(total_harga);

        });

        var my_table = "";

        $.each( result, function( key, row ) {
                    my_table += "<tr>";
                    my_table += "<td>"+row.produk+"</td>";
                    my_table += "<td>"+row.satuan+"</td>";
                    my_table += "<td>"+row.qty+"</td>";
                    my_table += "<td>Rp "+formatRupiah(row.harga)+"</td>";
                    my_table += "<td>Rp "+row.subtotal+"</td>";
                    my_table += "</tr>";
            });

            my_table = '<table id="table-fixed" class="table table-bordered table-hover" cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;">'+ 
                        '<thead>'+
                           ' <tr class="bg-success">'+
                                '<th>Produk</th>'+
                                '<th>Satuan</th>'+
                                '<th>Qty</th>'+
                                '<th>Harga</th>'+
                                '<th>Subtotal</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>' + my_table + '</tbody>'+
                       ' <tfoot>'+
                            '<tr class="bg-success">'+
                                '<th class="text-center" colspan="2">Total</th>'+
                                '<th>'+total_qty+'</th>'+
                                '<th></th>'+
                                '<th>Rp '+grand_total+'</th>'+
                            '</tr>'+
                            '</tfoot>'+
                        '</table>';

                    // $(document).append(my_table);
            
            console.log(my_table);
            return my_table;
            // mytable.appendTo("#box");	       
        
        }

 //FUNGSI BREAKDOWN
        $(document).ready(function() {
                    var table = $('#data-table').DataTable();
                
                    $('#data-table tbody').on( 'click', 'td.details-control', function () {
                        var tr = $(this).closest('tr');
                        var kode = tr.find('td:eq(1)').text();
                        var row = table.row( tr );
                        if ( $(this).hasClass('selected bg-gray') ) {
                            $(this).removeClass('selected bg-gray');
                        } else {
                            table.$('tr.selected').removeClass('selected bg-gray');
                            $(this).addClass('selected');
                        }
                        $.ajax({
                            url: '{!! route('pemakaian.showdetail') !!}',
                            type: 'POST',
                            data : {
                                'id': kode
                            },
                            success: function(result) {
                                console.log(result);
                                if(result.title == 'Gagal'){
                                    $.notify(result.message);
                                }else{
                                    if ( row.child.isShown() ) {
                                    row.child.hide();
                                    tr.removeClass('shown');
                                }
                                else {
                                // Open this row
                                // $.each(result, function (index, value) {
                                    
                                //         console.log(index + " :: " + value);
                                    
                                // });
                                    var len = result.length;
                                    for (var i = 0; i < len; i++) {
                                        console.log(result[i].produk,result[i].satuan,result[i].qty,result[i].harga);
                                        // alert(result[i].produk);
                                    }

                                    row.child( createTable(result) ).show();
                                    // row.child( format(result) ).show();
                                    tr.addClass('shown');
                                }
                            }
                            }
                        });

                        
                    } );
        } );

        // Fungsi POST-UNPOST,VIEW DETAIL,DAN PRINT
        $(document).ready(function() {
            var table = $('#data-table').DataTable();
            var post = document.getElementById("button1");
            var unpost = document.getElementById("button2");
           
        
            $('#data-table tbody').on( 'click', 'tr',function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray');
                    $(this).addClass('selected bg-gray');
                    var select = $('.selected').closest('tr');
                    var colom = select.find('td:eq(2)').text();
                    var no_pemakaian = select.find('td:eq(0)').text();
                    var status = colom;
                    var print = $("#button4").attr("href","http://localhost/inventory_baru/admin/pemakaian/cetakPDF?id="+no_pemakaian);
                    // var print = $("#button3").attr("href","{{ route('permintaan.cetak', ['id' =>"+colom2"])}}");
                    if(status =='POSTED'){
                        post.disabled = true;
                        unpost.disabled = false;
                    }else if(status =='UNPOSTED'){
                        unpost.disabled = true;
                        post.disabled = false;
                    }else{
                        unpost.disabled = true;
                        post.disabled = false;
                    }
                }
            });
        
            $('#button1').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_pemakaian = colom;
                console.log(no_pemakaian);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('pemakaian.post') !!}',
                    type: 'POST',
                    data : {
                        'id': no_pemakaian
                    },
                    success: function(result) {
                        console.log(result);
                        $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            } );

            $('#button2').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_pemakaian = colom;
                console.log(no_pemakaian);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('pemakaian.unpost') !!}',
                    type: 'POST',
                    data : {
                        'id': no_pemakaian
                    },
                    success: function(result) {
                        console.log(result);
                        $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            } );

            $('#button3').click( function () {
                var select = $('.selected').closest('tr');
                var no_pemakaian = select.find('td:eq(0)').text();
                var row = table.row( select );
                console.log(no_pemakaian);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('pemakaian.showdetail') !!}',
                    type: 'POST',
                    data : {
                        'id': no_pemakaian
                    },
                    success: function(result) {
                        console.log(result);
                        if(result.title == 'Gagal'){
                            $.notify(result.message);
                        }else{
                            if ( row.child.isShown() ) {
                            row.child.hide();
                            tr.removeClass('shown');
                        }
                        else {
                        // Open this row
                        // $.each(result, function (index, value) {
                            
                        //         console.log(index + " :: " + value);
                            
                        // });
                            var len = result.length;
                            for (var i = 0; i < len; i++) {
                                console.log(result[i].produk,result[i].satuan,result[i].qty,result[i].harga);
                                // alert(result[i].produk);
                            }

                            row.child( createTable(result) ).show();
                            // row.child( format(result) ).show();
                            select.addClass('shown');
                        }
                     }
                    }
                });
            } );
            
        } );

        $('.select2').select2({
            placeholder: " Pilih No Permintaan",
            allowClear: true,
        });

        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
             $('#data-table').DataTable().ajax.reload(null,false);;
        }

        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });

        $('.modal-dialog').resizable({
    
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
                        $('#Pemakaian').val(result.no_pemakaian);
                        // $('#Permintaan').val(result.no_permintaan);
                        $('#Tanggal').val(result.tanggal_pemakaian);
                        $('#Status').val(result.status);
                        $('#Type').val(result.type);
                        $('#Deskripsi').val(result.deskripsi);
                        $('#editform').modal('show');
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
                        $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            }

        }
    </script>
@endpush