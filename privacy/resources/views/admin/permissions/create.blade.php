@extends('adminlte::page')

@section('title', $info['title'] )


@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $info['title'] }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route' => ['permissions.store']]) !!}


        <div class="box-body">

            @include('errors.validation')

            <div class="row">
                <div class="col-md-4">
                   <div class="box">
                       <div class="box-header">
                           <h3 class="box-title">Permission Parameter</h3>
                       </div>
                       <div class="box-body">
                           <div class="form-group">
                               <label>
                                   {{ Form::checkbox('parameter[]', 'read',null) }} Read
                               </label>
                           </div>
                           <div class="form-group">
                               <label>
                                   {{ Form::checkbox('parameter[]', 'create',null) }} Create
                               </label>
                           </div>
                           <div class="form-group">
                               <label>
                                   {{ Form::checkbox('parameter[]', 'update',null) }} Update
                               </label>
                           </div>
                           <div class="form-group">
                               <label>
                                   {{ Form::checkbox('parameter[]', 'delete',null) }} Delete
                               </label>
                           </div>
                           <div class="form-group">
                               <label>
                                   {{ Form::checkbox('parameter[]', 'post',null) }} Post
                               </label>
                           </div>
                           <div class="form-group">
                               <label>
                                   {{ Form::checkbox('parameter[]', 'unpost',null) }} Unpost
                               </label>
                           </div>
                       </div>
                   </div>
                </div>

                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Permission Entry</h3>
                        </div>
                        <div class="box-body">

                                <div class="form-group">
                                    {{ Form::label('name', 'Name:') }}
                                    {{ Form::text('name', null, ['class'=> 'form-control', 'placeholder'=> 'Please enter permission name']) }}
                                    <p class="help-block">Example: editor, operator</p>
                                </div>

                            <div class="callout callout-info">
                                <h4>Info!</h4>
                                <p>Jika anda memilih parameter <code>create</code> dengan permission name <code>operator</code>.
                                    ini akan menghasilkan permission name <code>create-operator</code> ketika disimpan. Begitu juga dengan perameter yang lain.</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-floppy-o"></i> Simpan</button>
            <a href="{{ $info['list_url'] }}" class="btn btn-light pull-right"> <i class="fa fa-arrow-circle-left"></i> Kembali</a>
        </div>
        {!! Form::close() !!}
    </div>
@stop
@push('js')
    <script>


        var app = new Vue({
            el: '.box',
            data: {
                message: 'Hello Vue!'
            },

            mounted() {
                this.checkedAll()
            },

            methods: {
                update: function (event) {
                    var url = ''
                    var data = $('#form_roles_edit').serialize();

                    axios.put(url, data).then(function (response) {
                        console.log(response.data)
                        if (response.data.success){
                            $.notify(response.data.message, "success");
                        }
                    })
                },

                checkedAll: function (event) {
                    $('#checkAll').click(function () {
                        $('.selected').prop('checked', this.checked);
                    });
                }
            }
        })
    </script>
@endpush