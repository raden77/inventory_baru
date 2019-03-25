@extends('adminlte::page')

@section('title', 'Produk')

@section('content_header')
    <h1>Produk</h1>
    <style>
    td.details-control {
    background: url('../css/detail_open2.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
    background: url('../css/detail_minus2.png') no-repeat center center;
    }       
    </style>
@stop
<body>
    
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Produk</h3>
        </div>
        <div class="box-body">
            <div class="box ">
                <div class="box-body">
                    {{-- <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Produk</a> --}}
                    <button type="button" class="btn btn-default btn-sm" onclick="refreshTable()" >
                        <i class="fa fa-refresh"></i> Refresh</button>
                    @permission('create-produk')
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addform">
                        <i class="fa fa-plus"></i> New Produk</button>
                    @endpermission

                    {{-- <div class="col-md-6">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                                <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                              </ul>
                              <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                  <b>How to use:</b>
                  
                                  <p>Exactly like the original bootstrap tabs except you should use
                                    the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                                  A wonderful serenity has taken possession of my entire soul,
                                  like these sweet mornings of spring which I enjoy with my whole heart.
                                  I am alone, and feel the charm of existence in this spot,
                                  which was created for the bliss of souls like mine. I am so happy,
                                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                                  that I neglect my talents. I should be incapable of drawing a single stroke
                                  at the present moment; and yet I feel that I never was a greater artist than now.
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                  The European languages are members of the same family. Their separate existence is a myth.
                                  For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                  in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                  new common language would be desirable: one could refuse to pay expensive translators. To
                                  achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                  words. If several languages coalesce, the grammar of the resulting language is more simple
                                  and regular than that of the individual languages.
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                  when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                  It has survived not only five centuries, but also the leap into electronic typesetting,
                                  remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                  sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                  like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                                <!-- /.tab-pane -->
                              </div>
                              <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                  
                          <!-- /.col -->
                    </div> --}}
               
            </div>
        </div>
             <table class="table table-bordered table-hover" id="data-table" width="100%">
                <thead>
                    <tr class="bg-purple">
                        <th></th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Ukuran</th>
                        <th>Satuan</th>
                        <th>Type</th>
                        {{-- <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Hpp</th> --}}
                        <th>Stok</th>
                        {{-- <th>Aktif</th> --}}
                        {{-- <th>Company</th> --}}
                        {{-- <th>Created At</th>
                        <th>Updated At</th>
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
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Data</h4>
            </div>
            @include('errors.validation')
            {{-- {!! Form::open(['route' => ['produk.store'],'method' => 'post','id'=>'form']) !!} --}}
            {!! Form::open(['id'=>'ADD']) !!}
                    <div class="modal-body">
                        <div class="row">
                            <span class="col-md-12">
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('kode Produk', 'Kode Produk:') }}
                                        {{ Form::text('kode_produk', null, ['class'=> 'form-control','id'=>'Kode1']) }}
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('Nama Produk', 'Nama Produk:') }}
                                        {{ Form::text('nama_produk', null, ['class'=> 'form-control','id'=>'Nama1','required'=>'required']) }}
                                    </div>
                                </div>
                                {{-- <div class="col-md-5">
                                        <div class="form-group">
                                            {{ Form::label('kode_company', 'Company:') }}
                                            {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control','id'=>'Company1']) }}
                                        </div>
                                </div> --}}
                            </span>
                            <span class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('kode_kategori', 'Kategori:') }}
                                        {{ Form::select('kode_kategori',$Kategori,null, ['class'=> 'form-control','id'=>'Kategori1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('kode_merek', 'Merek:') }}
                                        {{ Form::select('kode_merek', $Merek,null, ['class'=> 'form-control','id'=>'Merek1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('kode_ukuran', 'Ukuran:') }}
                                        {{ Form::select('kode_ukuran', $Ukuran,null, ['class'=> 'form-control','id'=>'Ukuran1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('kode_satuan', 'Satuan:') }}
                                        {{ Form::select('kode_satuan', $Satuan,null, ['class'=> 'form-control','id'=>'Satuan1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('type', 'Type:') }}
                                        {{ Form::text('type', null, ['class'=> 'form-control','id'=>'Type1','required'=>'required']) }}
                                    </div>
                                </div>
                            </span>
                            <span class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('harga_beli', 'Harga Beli:') }}
                                        {{ Form::text('harga_beli', null, ['class'=> 'form-control','id'=>'Beli1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('harga_jual', 'Harga Jual:') }}
                                        {{ Form::text('harga_jual', null, ['class'=> 'form-control','id'=>'Jual1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('hpp', 'HPP:') }}
                                        {{ Form::text('hpp', null, ['class'=> 'form-control','id'=>'HPP1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('stok', 'Stok:') }}
                                        {{ Form::text('stok', null, ['class'=> 'form-control','id'=>'Stok1']) }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('aktif', 'Aktif:') }}
                                        {{ Form::text('aktif', null, ['class'=> 'form-control','id'=>'Aktif1']) }}
                                    </div>
                                </div>
                            </span>
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
            {{-- {!! Form::open( ['route' => ['produk.ajaxupdate'],'method' => 'post','id'=>'Update']) !!} --}}
            {!! Form::open(['id'=>'EDIT']) !!}
            <div class="modal-body">
                    <div class="row">
                        <span class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{-- {{ Form::label('kode Produk', 'Kode Produk:') }} --}}
                                    {{ Form::hidden('kode_produk', null, ['class'=> 'form-control','id'=>'Kode','readonly']) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('Nama Produk', 'Nama Produk:') }}
                                    {{ Form::text('nama_produk', null, ['class'=> 'form-control','id'=>'Nama','autofocus'=>'autofocus']) }}
                                </div>
                            </div>
                            {{-- <div class="col-md-5">
                                    <div class="form-group">
                                        {{ Form::label('kode_company', 'Company:') }}
                                        {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control','id'=>'Company']) }}
                                    </div>
                            </div> --}}
                        </span>
                        <span class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('kode_kategori', 'Kategori:') }}
                                    {{ Form::select('kode_kategori',$Kategori,null, ['class'=> 'form-control','id'=>'Kategori']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('kode_merek', 'Merek:') }}
                                    {{ Form::select('kode_merek', $Merek,null, ['class'=> 'form-control','id'=>'Merek']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('kode_ukuran', 'Ukuran:') }}
                                    {{ Form::select('kode_ukuran', $Ukuran,null, ['class'=> 'form-control','id'=>'Ukuran']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('kode_satuan', 'Satuan:') }}
                                    {{ Form::select('kode_satuan', $Satuan,null, ['class'=> 'form-control','id'=>'Satuan']) }}
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('type', 'Type:') }}
                                    {{ Form::text('type', null, ['class'=> 'form-control','id'=>'Tipe']) }}
                                </div>
                            </div>
                        </span>
                        <span class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('harga_beli', 'Harga Beli:') }}
                                    {{ Form::text('harga_beli', null, ['class'=> 'form-control','id'=>'Beli']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('harga_jual', 'Harga Jual:') }}
                                    {{ Form::text('harga_jual', null, ['class'=> 'form-control','id'=>'Jual']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('hpp', 'HPP:') }}
                                    {{ Form::text('hpp', null, ['class'=> 'form-control','id'=>'HPP']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('stok', 'Stok:') }}
                                    {{ Form::text('stok', null, ['class'=> 'form-control','id'=>'Stok']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('aktif', 'Aktif:') }}
                                    {{ Form::text('aktif', null, ['class'=> 'form-control','id'=>'Aktif']) }}
                                </div>
                            </div>
                        </span>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    {{ Form::submit('Update data', ['class' => 'btn btn-success']) }}
                    {{-- {{ Form::button('Update', ['class' => 'btn btn-primary','onclik'=>'update()','id'=>'edit']) }} --}}
                    {{ Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal']) }}&nbsp;
                </div>
            </div>
            {!! Form::close() !!}
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="showform" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Show Detail Data</h4>
            </div>
           
            <div class="modal-body">
                   <table class="table table-bordered table-striped" width="100%">
                    <tr>
                        <th width="40%">Kode Produk</th>
                        <td><p id="kode"></p></td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td><p id="nama"></p></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><p id="kategori"></p></td>
                    </tr>
                    <tr>
                        <th>Merek</th>
                        <td><p id="merek"></p></td>
                    </tr>
                    <tr>
                        <th>Ukuran</th>
                        <td><p id="ukuran"></p></td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td><p id="satuan"></p></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><p id="tipe"></p></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td><p id="stock"></p></td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td><p id="beli"></p></td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td><p id="jual"></p></td>
                    </tr>
                    <tr>
                        <th>Hpp</th>
                        <td><p id="hpps"></p></td>
                    </tr>
                    <tr>
                        <th>Aktif</th>
                        <td><p id="aktifs"></p></td>
                    </tr>
                    <tr>
                        <th>Company</th>
                        <td><p id="company"></p></td>
                    </tr>
                   </table>
            </div>
            <div class="modal-footer">
                <p id="url"></p>
            </div>

          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</body>
@stop

@push('css')

@endpush
@push('js')
  
<script>
        
        $(function() {
            $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('produk.data') !!}',
            
            columns: [
                {
                    "className":'details-control',
                    "orderable":false,
                    "data":null,
                    "defaultContent":''
                },
                { data: 'kode_produk', name: 'kode_produk' },
                { data: 'nama_produk', name: 'nama_produk' },
                { data: 'kategoriproduk.nama_kategori', name: 'kategoriproduk.nama_kategori' },
                // { data: 'kode_kategori', name: 'kode_kategori' },
                { data: 'merek.nama_merek', name: 'merek.nama_merek' },
                // { data: 'kode_merek', name: 'kode_merek' },
                { data: 'ukuran.nama_ukuran', name: 'ukuran.nama_ukuran' },
                //{ data: 'kode_ukuran', name: 'kode_ukuran' },
                { data: 'satuan.nama_satuan', name: 'satuan.nama_satuan' },
                //{ data: 'kode_satuan', name: 'kode_satuan' },
                { data: 'type', name: 'type' },
                // { data: 'harga_beli', name: 'harga_beli' },
                // { data: 'harga_jual', name: 'harga_jual' },
                // { data: 'hpp', name: 'hpp' },
                { data: 'stok', name: 'stok' },
                // { data: 'aktif', name: 'aktif' },
                // { data: 'company.nama_company', name: 'nama_company' },
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
        
            $('#data-table tbody').on( 'click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var kode = tr.find('td:eq(1)').text();
                var row = table.row( tr );
                $.ajax({
                    url: '{!! route('itembulanan.show') !!}',
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
                        row.child( format(result) ).show();
                        tr.addClass('shown');
                        }
                     }
                    }
                });

                
            } );
        
        } );

        // function format ( d ) {
        //     // `d` is the original data object for the row
        //     return '<table class="table  table-bordered table-hover" cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;">'+
        //         '<thead>'+
        //         '<tr class="bg-purple">'+
        //             '<th>Kode Produk:</th>'+
        //             '<th>In Stock:</th>'+
        //             '<th>In Amount:</th>'+
        //         '</tr>'+
        //         '</thead>'+
        //         '<tbody>'+
        //         '<tr>'+
        //             '<td>'+d.kode_produk+'</td>'+
        //             '<td>'+d.in_stock+'</td>'+
        //             '<td>'+d.in_stock+'</td>'+
        //         '</tr>'+
        //         '</tbody>'+
        //     '</table>';

        // }

        function format ( d ) {
            // `d` is the original data object for the row
            return '<div class="col-md-12">'+
                           ' <!-- Custom Tabs -->'+
                            '<div class="nav-tabs-custom">'+
                              '<ul class="nav nav-tabs">'+
                                '<li class="active"><a href="#tab_1" data-toggle="tab">View Monthly</a></li>'+
                               ' <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>'+
                                '<li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>'+
                              '</ul>'+
                              '<div class="tab-content">'+
                                '<div class="tab-pane active" id="tab_1">'+
                                    '<table class="table  table-bordered table-hover" cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;">'+
                                    '<thead>'+
                                    '<tr class="bg-purple">'+
                                        '<th>Periode:</th>'+
                                        '<th>Kode Produk:</th>'+
                                        '<th>Satuan:</th>'+
                                        '<th>Begin Stock:</th>'+
                                        '<th>Begin Amount:</th>'+
                                        '<th>In Stock:</th>'+
                                        '<th>In Amount:</th>'+
                                    '</tr>'+
                                    '</thead>'+
                                    '<tbody>'+
                                    '<tr>'+
                                        '<td>'+d.periode+'</td>'+
                                        '<td>'+d.kode_produk+'</td>'+
                                        '<td>'+d.satuan+'</td>'+
                                        '<td>'+d.begin_stock+'</td>'+
                                        '<td>'+d.begin_amount+'</td>'+
                                        '<td>'+d.in_stock+'</td>'+
                                        '<td>'+d.in_amount+'</td>'+
                                    '</tr>'+
                                    '</tbody>'+
                                '</table>'+
                                '</div>'+
                                '<!-- /.tab-pane -->'+
                                '<div class="tab-pane" id="tab_2">'+
                                'ok2'+
                                '</div>'+
                               ' <!-- /.tab-pane -->'+
                                '<div class="tab-pane" id="tab_3">'+
                                'ok3'+
                               ' </div>'+
                                '<!-- /.tab-pane -->'+
                              '</div>'+
                            '  <!-- /.tab-content -->'
                            '</div>'+
                            '<!-- nav-tabs-custom -->'+
                         ' <!-- /.col -->'+
                    ' </div>'
            ;
        }

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

        $('#ADD').submit(function (e) {
            e.preventDefault();
            // Get the Login Name value and trim it
            // var kode = $.trim($('#Kode1').val());
            var name = $.trim($('#Nama1').val());
            var kategori = $.trim($('#Kategori1').val());
            var merek = $.trim($('#Merek1').val());
            var ukuran = $.trim($('#Ukuran1').val());
            var satuan = $.trim($('#Satuan1').val());
            // var company = $.trim($('#Company1').val());
            var type = $.trim($('#Type1').val());
            var beli = $.trim($('#Beli1').val());
            var jual = $.trim($('#Jual1').val());
            var hpp = $.trim($('#HPP1').val());
            var stok = $.trim($('#Stok1').val());
            var aktif = $.trim($('#Aktif1').val());
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (name === ''|| kategori === ''|| merek === ''|| ukuran === ''|| satuan === ''|| type === ''|| beli === ''|| jual === ''|| hpp === ''|| stok === ''|| aktif === '') {
                alert('Mohon Lengkapi Form Isian');
                return false;
            }else{
                $.ajax({
                    url:'{!! route('produk.store') !!}',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        // $('#Kode1').val('');
                        $('#Nama1').val('');
                        $('#Kategori1').val('');
                        $('#Merek1').val('');
                        $('#Ukuran1').val('');
                        $('#Satuan1').val('');
                        // $('#Company1').val('');
                        $('#Type1').val('');
                        $('#Beli1').val('');
                        $('#Jual1').val('');
                        $('#HPP1').val('');
                        $('#Stok1').val('');
                        $('#Aktif1').val('');
                        $('#addform').modal('hide');
                        refreshTable();
                        $.notify(data.message, "success");
                    },
                });
            }
        });

        $('#EDIT').submit(function (e) {
            e.preventDefault();
            // Get the Login Name value and trim it
            var kode = $.trim($('#Kode').val());
            var name = $.trim($('#Nama').val());
            var kategori = $.trim($('#Kategori').val());
            var merek = $.trim($('#Merek').val());
            var ukuran = $.trim($('#Ukuran').val());
            var satuan = $.trim($('#Satuan').val());
            // var company = $.trim($('#Company').val());
            var type = $.trim($('#Tipe').val());
            var beli = $.trim($('#Beli').val());
            var jual = $.trim($('#Jual').val());
            var hpp = $.trim($('#HPP').val());
            var stok = $.trim($('#Stok').val());
            var aktif = $.trim($('#Aktif').val());
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (kode === '' || name === ''|| kategori === ''|| merek === ''|| ukuran === ''|| satuan === ''||  type === ''|| beli === ''|| jual === ''|| hpp === ''|| stok === ''|| aktif === '') {
                alert('Mohon Lengkapi Form Isian');
                return false;
            }else{
                $.ajax({
                    url:'{!! route('produk.ajaxupdate') !!}',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#editform').modal('hide');
                        refreshTable();
                        $.notify(data.message, "success");
                    },
                });
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
                        $('#Kode').val(result.kode_produk);
                        $('#Nama').val(result.nama_produk);
                        $('#Kategori').val(result.kode_kategori);
                        $('#Merek').val(result.kode_merek);
                        $('#Ukuran').val(result.kode_ukuran);
                        $('#Satuan').val(result.kode_satuan);
                        $('#Company').val(result.kode_company);
                        $('#Tipe').val(result.type);
                        $('#Beli').val(result.harga_beli);
                        $('#Jual').val(result.harga_jual);
                        $('#HPP').val(result.hpp);
                        $('#Stok').val(result.stok);
                        $('#Aktif').val(result.aktif);
                        $('#showform').modal('hide');
                        $('#editform').modal('show');
                    }
                });
            }
        }

        function show(id, url) {
            
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result){
                        console.log(result);
                        $('#kode').html(result.kode_produk);
                        $('#nama').html(result.nama_produk);
                        $('#kategori').html(result.kode_kategori);
                        $('#merek').html(result.kode_merek);
                        $('#ukuran').html(result.kode_ukuran);
                        $('#satuan').html(result.kode_satuan);
                        $('#company').html(result.kode_company);
                        $('#tipe').html(result.type);
                        $('#beli').html(result.harga_beli);
                        $('#jual').html(result.harga_jual);
                        $('#hpps').html(result.hpp);
                        $('#stock').html(result.stok);
                        $('#aktifs').html(result.aktif);
                        $('#url').html(result.url);
                        $('#showform').modal('show');
                    }
                });
            
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