@extends('adminlte::page')

@section('title', 'Penerimaan')

@section('content_header')
    
@stop

@section('content')
    <div class="box box-solid box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Penerimaan</h3>
        </div>
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    {{-- <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Penerimaan</a> --}}
                    <button type="button" class="btn btn-default btn-sm" onclick="refreshTable()" >
                            <i class="fa fa-refresh"></i> Refresh</button>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addform">
                        <i class="fa fa-plus"></i> New Penerimaan</button>
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
                <tr class="bg-warning">
                    <th>No Penerimaan</th>
                    <th>No Pembelian</th>
                    <th>Tanggal Penerimaan</th>
                    <th>Status</th>
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
    <div class="modal fade" id="addform" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Data</h4>
            </div>
            @include('errors.validation')
            {!! Form::open(['route' => ['penerimaan.store'],'method' => 'post','id'=>'form1']) !!}
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('No Penerimaan', 'No Penerimaan:') }}
                                    {{ Form::text('no_penerimaan', null, ['class'=> 'form-control']) }}
                                 </div>
                            </div>  --}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('No Pembelian', 'No Pembelian:') }}
                                    {{-- {{ Form::text('no_pembelian', null, ['class'=> 'form-control']) }} --}}
                                    {{ Form::select('no_pembelian',$Pembelian,null, ['class'=> 'form-control select2','style'=>'width: 100%']) }}
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Tanggal Penerimaan', 'Tanggal Penerimaan:') }}
                                    {{ Form::date('tanggal_penerimaan', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                    {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                </div>
                            </div>
    
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('status', 'Status:') }}
                                    {{ Form::text('status', null, ['class'=> 'form-control']) }}
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('kode_company', 'Company:') }}
                                    {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
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
                {!! Form::open(['route' => ['penerimaan.updateajax'],'method' => 'post','id'=>'form']) !!}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('No Penerimaan', 'No Penerimaan:') }}
                                        {{ Form::text('no_penerimaan', null, ['class'=> 'form-control','id'=>'Penerimaan','readonly']) }}
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('No Pembelian', 'No Pembelian:') }}
                                        {{-- {{ Form::text('no_pembelian', null, ['class'=> 'form-control','id'=>'Pembelian']) }} --}}
                                        {{ Form::select('no_pembelian',$Pembelian,null, ['class'=> 'form-control','id'=>'Pembelian']) }}
                                        
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('Tanggal Penerimaan', 'Tanggal Penerimaan:') }}
                                        {{ Form::date('tanggal_penerimaan', null,['class'=> 'form-control','id'=>'Tanggal'])}}
                                        {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                    </div>
                                </div>
        
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('status', 'Status:') }}
                                        {{ Form::text('status', null, ['class'=> 'form-control','id'=>'Status']) }}
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('kode_company', 'Company:') }}
                                        {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control']) }}
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
            ajax: '{!! route('penerimaan.data') !!}',
            
            columns: [
                { data: 'no_penerimaan', name: 'no_penerimaan' },
                { data: 'no_pembelian', name: 'no_pembelian' },
                { data: 'tanggal_penerimaan', name: 'tanggal_penerimaan' },
                { data: 'status', name: 'status' },
                { data: 'penerimaandetail_count', name: 'penerimaandetail_count' },
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
                }
                else {
                    table.$('tr.selected').removeClass('selected bg-gray');
                    $(this).addClass('selected bg-gray');
                    var select = $('.selected').closest('tr');
                    var colom = select.find('td:eq(3)').text();
                    var no_penerimaan = select.find('td:eq(0)').text();
                    var status = colom;
                    var print = $("#button3").attr("href","http://localhost/inventory_baru/admin/penerimaan/cetakPDF?id="+no_penerimaan);
                    // var print = $("#button3").attr("href","{{ route('permintaan.cetak', ['id' =>"+colom2"])}}");
                    if(status == 'POSTED'){
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
            } );
        
            $('#button1').click( function () {
                var select = $('.selected').closest('tr');
                var colom = select.find('td:eq(0)').text();
                var no_penerimaan = colom;
                console.log(no_penerimaan);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('penerimaan.post') !!}',
                    type: 'POST',
                    data : {
                        'id': no_penerimaan
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
                var no_penerimaan = colom;
                console.log(no_penerimaan);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('penerimaan.unpost') !!}',
                    type: 'POST',
                    data : {
                        'id': no_penerimaan
                    },
                    success: function(result) {
                        console.log(result);
                        $.notify(result.message, "success");
                        refreshTable();
                    }
                });
            } );
        } );

        $('.select2').select2({
            placeholder: " Pilih No Pembelian",
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
                        $('#Penerimaan').val(result.no_penerimaan);
                        $('#Pembelian').val(result.no_pembelian);
                        $('#Tanggal').val(result.tanggal_penerimaan);
                        $('#Status').val(result.status);
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