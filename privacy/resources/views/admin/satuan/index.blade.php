@extends('adminlte::page')

@section('title', 'Satuan')

@section('content_header')
    <h1>Satuan</h1>
@stop

@section('content')
<body>
    

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Satuan</h3>
        </div>
        <div class="box-body">
            <div class="box ">
                <div class="box-body">
                    {{-- <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Satuan</a> --}}
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addform">
                        <i class="fa fa-plus"></i> New Satuan</button>
                </div>
            </div>
             <table class="table table-bordered table-hover" id="satuan-table" width="100%">
                <thead>
                <tr class="bg-purple">
                    <th>Kode Satuan</th>
                    <th>Nama Satuan</th>
                    <th>Status</th>
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

<div class="modal fade" id="addform" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Data</h4>
            </div>
            @include('errors.validation')
            {{-- {!! Form::open(['route' => ['satuan.store'],'method' => 'post','id'=>'form']) !!} --}}
            {!! Form::open(['id'=>'ADD']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode satuan', 'Kode Satuan:') }}
                                {{ Form::text('kode_satuan', null, ['class'=> 'form-control','id'=>'Kode1']) }}
                                <span class="text-danger">
                                    <strong class="kode-error" id="kode-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('nama_satuan', 'Nama Satuan:') }}
                                {{ Form::text('nama_satuan', null, ['class'=> 'form-control','id'=>'Nama1','required'=>'required']) }}
                                <span class="text-danger">
                                    <strong class="name-error" id="name-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('status', 'Status:') }} <br>
                                {{Form::select('status', ['1' => 'Aktif', '0' => 'Non Aktif'], '1', ['class'=> 'form-control','id'=>'Status1'])}}
                                <span class="text-danger">
                                    <strong class="status-error" id="status-error"></strong>
                                </span>
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
            {{-- {!! Form::open( ['route' => ['satuan.ajaxupdate'],'method' => 'post','id'=>'Update']) !!} --}}
            {!! Form::open(['id'=>'EDIT']) !!}
            <div class="modal-body">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('kode satuan', 'Kode Satuan:') }}
                            {{ Form::text('kode_satuan', null, ['class'=> 'form-control','id'=>'Kode']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('nama_satuan', 'Nama Satuan:') }}
                            {{ Form::text('nama_satuan', null, ['class'=> 'form-control','id'=>'Nama']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('status', 'Status:') }}<br>
                            {{Form::select('status', ['1' => 'Aktif', '0' => 'Non Aktif'], null, ['class'=> 'form-control','id'=>'Status'])}}
                        </div>
                    </div>
                    </div>
            </div>

            <div class="modal-footer">
                    <div class="row">
                    {{ Form::submit('Update data', ['class' => 'btn btn-success']) }}
                    {{ Form::button('Close', ['class' => 'btn btn-danger','data-dismiss'=>'modal']) }}&nbsp;
                    </div>
            </div>
            {!! Form::close() !!}
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
            $('#satuan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('satuan.data') !!}',
            columns: [
                { data: 'kode_satuan', name: 'kode_satuan' },
                { data: 'nama_satuan', name: 'nama_satuan' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                // { data: 'updated_at', name: 'updated_at' },
                // { data: 'created_by', name: 'created_by' },
                // { data: 'updated_by', name: 'updated_by' },
                { data: 'action', name: 'action' }
            ]
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function refreshTable() {
             $('#satuan-table').DataTable().ajax.reload(null,false);;
        }

        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });

        $('.modal-dialog').resizable({
    
        });

        $('#ADD').submit(function (e) {
            e.preventDefault();
            // Get the Login Name value and trim it
            var kode = $.trim($('#Kode1').val());
            var name = $.trim($('#Nama1').val());
            var status = $.trim($('#Status1').val());
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (kode === '' || name === '' || status === '') {
                    if(kode === ''){
                        $( '.kode-error' ).html('Mohon di Isi');
                    }
                    if(name === ''){
                        $( '.name-error' ).html('Mohon di Isi');
                    }
                    if(status === ''){
                        $( '.status-error' ).html('Mohon di Isi');
                    }

                // alert('Mohon Lengkapi Form Isian');
                // return false;
            }else{
                $.ajax({
                    url:'{!! route('satuan.store') !!}',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#Kode1').val('');
                        $('#Nama1').val('');
                        $('#Status1').val('');
                        $( '.kode-error' ).html('');
                        $( '.name-error' ).html('');
                        $( '.status-error' ).html('');
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
            var status = $.trim($('#Status').val());
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (kode === '' || name === '' || status === '' ) {
                alert('Mohon Lengkapi Form Isian');
                return false;
            }else{
                $.ajax({
                    url:'{!! route('satuan.ajaxupdate') !!}',
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
                        $('#Kode').val(result.kode_satuan);
                        $('#Nama').val(result.nama_satuan);
                        $('#Status').val(result.status);

                        $('#editform').modal('show');
                    }
                });
            }
        }

        function update() {
         e.preventDefault();
         var form_action = $("#editform").find("form").attr("action");
                $.ajax({
                    
                    url: form_action,
                    type: 'POST',
                    data:$('#Update').serialize(),
                    success: function(data) {
                        console.log(data);
                        $('#editform').modal('hide');
                        $.notify(data.message, "success");
                        refreshTable();
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