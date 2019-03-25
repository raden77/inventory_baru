@extends('adminlte::page')

@section('title', 'Users Create')


@section('content')
{{--    {{ dd($info['title']) }}--}}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $info['title'] }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route' => ['roles.store']]) !!}


            <div class="box-body">

                @include('errors.validation')

                <div class="form-group">
                    {{ Form::label('name', 'Display Name: *') }}
                    {{ Form::text('display_name', null, ['class'=> 'form-control']) }}
                </div>  
                
                <div class="form-group">
                    {{ Form::label('name', 'name: *') }}
                    {{ Form::text('name', null, ['class'=> 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('description', 'Description:') }}
                    {{ Form::text('description', null, ['class'=> 'form-control']) }}
                </div>

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permission</h3>
                    </div>
                    <table class="table table-bordered">
                        @foreach($permissions->groupBy('tab') as $key => $value)
                            <thead>
                                <tr>
                                    <th colspan="3">{{ $key }}</th>
                                </tr>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>Permission</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($value as $row)
                                <tr>
                                    <td>{{ Form::checkbox('permission[]', $row->id, null,['class' => 'selected'] ) }}</td>
                                    <td>{{ $row->display_name }}</td>
                                    <td>{{ $row->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endforeach
                    </table>
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