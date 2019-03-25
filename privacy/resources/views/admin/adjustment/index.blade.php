@extends('adminlte::page')

@section('title', 'Adjustment')

@section('content_header')
    
@stop

@section('content')
    <div class="box box-solid box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Adjustment</h3>
        </div>
        <div class="box-body">
            <div class="box">
                <div class="box-body">
                    {{-- <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Pembelian</a> --}}
                    <button type="button" class="btn btn-default btn-sm" onclick="refreshTable()" >
                            <i class="fa fa-refresh"></i> Refresh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addform"><i class="fa fa-plus">
                        </i> New Adjustment</button>
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
                <tr class="bg-danger">
                    <th>No Penyesuaian</th>
                    <th>Tanggal</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th></th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    {{-- <th>Created At</th> --}}
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
            {!! Form::open(['route' => ['adjustment.store'],'method' => 'post','id'=>'form1']) !!}
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Tanggal', 'Tanggal:') }}
                                    {{ Form::date('tanggal', \Carbon\Carbon::now(),['class'=> 'form-control'])}}
                                    {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Kode Produk', 'Produk:') }}
                                    {{ Form::select('kode_produk',$produk,null, ['class'=> 'form-control']) }}
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('nama_produk', 'Nama Produk:') }}
                                    {{ Form::text('nama_produk', null, ['class'=> 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('jumlah', 'Jumlah:') }}
                                    {{ Form::text('jumlah', null, ['class'=> 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('keterangan', 'Keterangan:') }}
                                    {{ Form::textArea('keterangan', null, ['class'=> 'form-control','rows'=>'4']) }}
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
                {!! Form::open(['route' => ['adjustment.updateAdjusment'],'method' => 'post','id'=>'form']) !!}
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('No Penyesuaian', 'No Penyesuaian:') }}
                                        {{ Form::text('no_penyesuaian', null, ['class'=> 'form-control','id'=>'Penyesuaian','readonly']) }}
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('Tanggal', 'Tanggal Penyesuaian:') }}
                                        {{ Form::date('tanggal', null,['class'=> 'form-control','id'=>'TanggalP'])}}
                                        {{-- {{ Form::text('tanggal_permintaan', null, ['class'=> 'form-control']) }} --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Kode Produk', 'Kode Produk:') }}
                                        {{ Form::select('kode_produk',$produk,null, ['class'=> 'form-control','id'=>'Kode']) }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('nama_produk', 'Nama Produk:') }}
                                        {{ Form::text('nama_produk', null, ['class'=> 'form-control','id'=>'NamaP']) }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('jumlah', 'Jumlah:') }}
                                        {{ Form::text('jumlah', null, ['class'=> 'form-control','id'=>'Jumlah']) }}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('keterangan', 'Keterangan:') }}
                                        {{ Form::textArea('keterangan', null, ['class'=> 'form-control','rows'=>'4','id'=>'Keterangan']) }}
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
@stop

@push('css')

@endpush
@push('js')
  
    <script>
        $(function() {
            $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('adjustment.data') !!}',
            scrollY: true,
            columns: [
                { data: 'no_penyesuaian', name: 'no_penyesuaian' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'kode_produk', name: 'kode_produk' },
                { data: 'nama_produk', name: 'nama_produk' },
                { data: 'jumlah', name: 'jumlah' },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'status', name: 'status' },
                // { data: 'created_at', name: 'created_at' },
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
                    var colom = select.find('td:eq(6)').text();
                    var no_pembelian = select.find('td:eq(0)').text();
                    var status = colom;
                    var print = $("#button3").attr("href","http://localhost/inventory_baru/admin/pembelian/cetakPDF?id="+no_pembelian);
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
                var no_penyesuaian = colom;
                console.log(no_penyesuaian);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('adjustment.post') !!}',
                    type: 'POST',
                    data : {
                        'id': no_penyesuaian
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
                var no_penyesuaian = colom;
                console.log(no_penyesuaian);
                // alert( table.rows('.selected').data().length +' row(s) selected' );
                $.ajax({
                    url: '{!! route('adjustment.unpost') !!}',
                    type: 'POST',
                    data : {
                        'id': no_penyesuaian
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
                        $('#Penyesuaian').val(result.no_penyesuaian);
                        $('#TanggalP').val(result.tanggal);
                        $('#Kode').val(result.kode_produk);
                        $('#NamaP').val(result.nama_produk);
                        $('#Jumlah').val(result.jumlah);
                        $('#Keterangan').val(result.keterangan);
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

        // var myselect = $('.select2').select2({
        //     placeholder: " Pilih No Permintaan",
        //     allowClear: true,
        // });

        // myselect.on('change', function(e){
        //         var selected_element = $(e.currentTarget);
        //         var select_val = selected_element.val();
        //         // var _token = $("input[name='_token']").val();
        //         console.log(select_val);
        //             $.ajax({        // Memulai ajax
        //                 method: "GET",      
        //                 url: "{!! route('pembelian.cari') !!}",    // file PHP yang akan merespon ajax
        //                 data: { id: select_val}   // data POST yang akan dikirim
        //               })
        //             .done(function(hasilajax) {   // KETIKA PROSES Ajax Request Selesai
                    
        //                 $('.select2').val(hasilajax.no_permintaan);
        //             });
        //          })
    </script>
@endpush