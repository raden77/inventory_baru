@extends('adminlte::page')

@section('title', 'Ukuran')

@section('content_header')
    <h1>Ukuran</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Manages Ukuran</h3>
        </div>
        <div class="box-body">
            <div class="box ">
                <div class="box-body">
                    {{-- <a href="{{ $create_url }}" class="btn btn-info btn-sm">New Ukuran</a> --}}
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addform">
                        <i class="fa fa-plus"></i> New Ukuran</button>
                </div>
            </div>
             <table class="table table-bordered table-hover" id="ukuran-table" width="100%">
                <thead>
                <tr class="bg-purple">
                    <th>Kode Ukuran</th>
                    <th>Nama Ukuran</th>
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
            {{-- {!! Form::open(['route' => ['ukuran.store'],'method' => 'post','id'=>'form']) !!} --}}
            {!! Form::open(['id'=>'ADD']) !!}
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('kode ukuran', 'Kode Ukuran:') }}
                                {{ Form::text('kode_ukuran', null, ['class'=> 'form-control','id'=>'Kode1']) }}
                                <span class="text-danger">
                                    <strong class="kode-error" id="kode-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('nama_ukuran', 'Nama Ukuran:') }}
                                {{ Form::text('nama_ukuran', null, ['class'=> 'form-control','id'=>'Nama1','required'=>'required']) }}
                                <span class="text-danger">
                                    <strong class="name-error" id="name-error"></strong>
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
                
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
{!! Form::close() !!}

<div class="modal fade" id="editform" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Data</h4>
            </div>
            @include('errors.validation')
            {{-- {!! Form::open( ['route' => ['ukuran.ajaxupdate'],'method' => 'post','id'=>'Update']) !!} --}}
            {!! Form::open(['id'=>'EDIT']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('kode ukuran', 'Kode Ukuran:') }}
                            {{ Form::text('kode_ukuran', null, ['class'=> 'form-control','id'=>'Kode']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('nama ukuran', 'Nama Ukuran:') }}
                            {{ Form::text('nama_ukuran', null, ['class'=> 'form-control','id'=>'Nama']) }}
                        </div>
                    </div>
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
@stop

@push('css')

@endpush
@push('js')
  
    <script>
        $(function() {
            $('#ukuran-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('ukuran.data') !!}',
            columns: [
                { data: 'kode_ukuran', name: 'kode_ukuran' },
                { data: 'nama_ukuran', name: 'nama_ukuran' },
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
             $('#ukuran-table').DataTable().ajax.reload(null,false);;
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
            var registerForm = $("#ADD");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (kode === '' || name === '') {
                    if(kode === ''){
                        $( '.kode-error' ).html('Mohon di Isi');
                    }
                    if(name === ''){
                        $( '.name-error' ).html('Mohon di Isi');
                    }

                // alert('Mohon Lengkapi Form Isian');
                // return false;
            }else{
                $.ajax({
                    url:'{!! route('ukuran.store') !!}',
                    type:'POST',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        $('#Kode1').val('');
                        $('#Nama1').val('');
                        $('.kode-error').html('');
                        $('.name-error').html('');
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
            var registerForm = $("#EDIT");
            var formData = registerForm.serialize();

            // Check if empty of not
            if (kode === '' || name === '') {
                alert('Mohon Lengkapi Form Isian');
                return false;
            }else{
                $.ajax({
                    url:'{!! route('ukuran.ajaxupdate') !!}',
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
                        $('#Kode').val(result.kode_ukuran);
                        $('#Nama').val(result.nama_ukuran);
                        // $('#Update').attr('action','satuan.ajaxupdate'+','+'result.kode_satuan')
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