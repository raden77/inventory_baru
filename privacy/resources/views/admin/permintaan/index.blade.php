@extends('adminlte::page')

@section('title', 'Permintaan')

@section('content_header')
    <h1>Permintaan</h1>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
    <style>
       
        
    </style>
@stop

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Permintaan</h3>
        </div>
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    {{-- <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Permintaan</a> --}}
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addform"><i class="fa fa-plus"></i> New Permintaan</button>
                    <span class="pull-right"> 
                        <button type="button" class="btn btn-success btn-sm" id="button1"><i class="fa fa-bullhorn"></i> POST</button>
                        <button type="button" class="btn btn-warning btn-sm" id="button2"><i class="fa fa-undo"></i> UNPOST</button>
                        {{-- <button type="button" class="btn btn-default btn-sm" id="button3"><i class="fa fa-print"></i> PRINT</button> --}}
                        <a href="#" target="_blank" class="btn btn-default btn-sm" id="button3">
                            <i class="fa fa-print"></i>PRINT
                        </a>
                    </span>
                </div>
            </div>
            <table class="table table-bordered table-hover" id="data-table" width="100%">
                <thead>
                <tr class="bg-primary">
                    <th>No Permintaan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Permintaan</th>
                    <th>Type</th>
                    <th>Status</th>
                    {{-- <th>Company</th> --}}
                    <th>Created At</th>
                    {{-- <th>Updated At</th>
                    <th>Created By</th>
                    <th>Updated By</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>

<div class="modal fade" id="addform" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Data</h4>
            </div>
            @include('errors.validation')
            {!! Form::open(['route' => ['permintaan.store'],'method' => 'post','id'=>'form']) !!}
                    <div class="modal-body">
                        <div class="row">
                            
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('No Permintaan', 'No Permintaan:') }}
                                    {{ Form::text('no_permintaan', null, ['class'=> 'form-control']) }}
                                </div>
                            </div> --}}
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Tanggal Permintaan', 'Tanggal Permintaan:') }}
                                    {{ Form::date('tanggal_permintaan', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                    {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('Type', 'Type:') }}
                                    {{ Form::select('type', ['Umum' => 'Umum', 'Mobil' => 'Mobil','Alat' => 'Alat',
                                'Jasa' => 'Jasa','Stok' => 'Stok'], null, ['class'=> 'form-control'])}}
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

                            <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('Deskripsi', 'Deskripsi:') }}
                                        {{ Form::textArea('deskripsi', null, ['class'=> 'form-control','rows'=>'4']) }}
                                    </div>
                                </div>
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
                {!! Form::open(['route' => ['permintaan.updateajax'],'method' => 'post','id'=>'form']) !!}
                        <div class="modal-body">
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('No Permintaan', 'No Permintaan:') }}
                                        {{ Form::text('no_permintaan', null, ['class'=> 'form-control','readonly','id'=>'Permintaan']) }}
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('Tanggal Permintaan', 'Tanggal Permintaan:') }}
                                        {{ Form::date('tanggal_permintaan', null,['class'=> 'form-control','id'=>'Tanggal'])}}
                                        {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('Type', 'Type:') }}
                                        {{ Form::select('type', ['Umum' => 'Umum', 'Mobil' => 'Mobil','Alat' => 'Alat',
                                    'Jasa' => 'Jasa','Stok' => 'Stok'], null, ['class'=> 'form-control','id'=>'Type'])}}
                                    </div>
                                </div>
    
                                {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('kode_company', 'Company:') }}
                                            {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control','id'=>'Company']) }}
                                        </div>
                                </div> --}}
        
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('status', 'Status:') }}
                                        {{ Form::text('status', null, ['class'=> 'form-control','id'=>'Status']) }}
                                    </div>
                                </div> --}}
    
                                <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('Deskripsi', 'Deskripsi:') }}
                                            {{ Form::textArea('deskripsi', null, ['class'=> 'form-control','rows'=>'4','id'=>'Deskripsi']) }}
                                        </div>
                                    </div>
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

<div class="modal fade" id="pdf" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Data</h4>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <p id="url" class=""></p>     
                    </div>
                </div>    
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
@stop

@push('css')

@endpush
@push('js')
<script src="http://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script>
        $(function() {
            $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            order: [[ 5, "desc" ]],
            ajax: '{!! route('permintaan.data') !!}',
            scrollX: true,
            columns: [
                { data: 'no_permintaan', name: 'no_permintaan' },
                { data: 'deskripsi', name: 'deskripsi' },
                { data: 'tanggal_permintaan', name: 'tanggal_permintaan' },
                { data: 'type', name: 'type' },
                { data: 'status', name: 'status' },
                // { data: 'company.nama_company', name: 'company.nama_company' },
                { data: 'created_at', name: 'created_at' },
                // { data: 'updated_at', name: 'updated_at' },
                // { data: 'created_by', name: 'created_by' },
                // { data: 'updated_by', name: 'updated_by' },
                { data: 'action', name: 'action' }
            ]
            });
        });

        $(document).ready(function() {
            var table = $('#data-table').DataTable();
            var post = document.getElementById("button1");
            var unpost = document.getElementById("button2");
           
            $('#data-table tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                    var rowData = table.rows().data().toArray();
                    console.log(rowData);
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray');
                    $(this).addClass('selected bg-gray');
                    var select = $('.selected').closest('tr');
                    var colom = select.find('td:eq(4)').text();
                    var no_permintaan = select.find('td:eq(0)').text();
                    var status = colom;
                    var print = $("#button3").attr("href","http://localhost/inventory_baru/admin/permintaan/cetakPDF?id="+no_permintaan);
                    // var print = $("#button3").attr("href","{{ route('permintaan.cetak', ['id' =>"+colom2"])}}");
                   
                    if(status == 'POSTED'){
                        post.disabled = true;
                        unpost.disabled = false;
                    }else if(status =='UNPOSTED'){
                        unpost.disabled = true;
                        post.disabled = false;
                    }else{
                        unpost.disabled = false;
                        post.disabled = false;
                    }
                    
                }
            } );
        
            $('#button1').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_permintaan = colom;
                console.log(no_permintaan);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('permintaan.post') !!}',
                    type: 'POST',
                    data : {
                        'id': no_permintaan
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
                var no_permintaan = colom;
                console.log(no_permintaan);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('permintaan.unpost') !!}',
                    type: 'POST',
                    data : {
                        'id': no_permintaan
                    },
                    success: function(result) {
                        console.log(result);
                        $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            } );

        } );

        // $( "#data-table" ).selectable();

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
                        $('#Permintaan').val(result.no_permintaan);
                        $('#Tanggal').val(result.tanggal_permintaan);
                        $('#Type').val(result.type);
                        $('#Company').val(result.kode_company);
                        $('#Status').val(result.status);
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