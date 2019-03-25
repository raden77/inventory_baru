@extends('adminlte::page')

@section('title', $info['title'])


@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $info['title'] }}</h3>
        </div>
        {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'put', '@submit.prevent' => 'update', 'id' => 'form_roles_edit']) !!}


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
                    <label class="pull-right">
                        <input type="checkbox" id="checkAll" @click="checkedAll()" ></input>
                        Pilih Semua
                    </label>
                </div>
                <table class="table">
                    @foreach($permissions->groupBy('tab') as $key => $value)
                        <thead>
                        <tr>
                            <th colspan="3">{{ $key }}</th>
                        </tr>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Permission</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($value as $row)
                            <tr>
                                <td class="text-center">{{ Form::checkbox('permission[]', $row->id, array_has($get_permission, $row->name),['class' => 'selected'] ) }}</td>
                                <td>{{ $row->display_name }}</td>
                                <td>{{ $row->description }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="box-footer">
                <button type="submit" class="btn btn-primary" v-if="!loading"> <i class="fa fa-floppy-o"></i> Simpan</button>
                <button type="button" disabled="disabled" class="btn btn-warning" v-else> <i class="fa fa-"></i> Mohon tunggu ..</button>
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
                loading: false,
            },

            mounted() {
                // this.checkedAll()
            },

            methods: {
                update: function (event) {
                    var url = '{{ $role->update_url }}'
                    var data = $('#form_roles_edit').serialize();
                    this.loading = true;

                    axios.put(url, data).then(function (response) {
                        console.log(response.data)
                        if (response.data.success){
                            $.notify(response.data.message, "success");
                            this.loading = false;
                        }
                    }.bind(this))
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
