@extends('adminlte::page')

@section('title', 'Users Create')

@section('content_header')
    <h1>User Data</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create User</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-info">
                <div class="box-body">
                    <a href="{{ $list_url }}" class="btn btn-default btn-sm">Lihat Data</a>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('users.store') }}">
                {{ csrf_field() }}
                <div class="box box-success">
                <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                    <hr>
                    <div class="form-group">
                        <label for="roles" class="col-md-4 control-label">Roles:</label>
                        <div class="col-md-6">
                            <select name="roles[]" id="role" multiple class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('kode_company') ? ' has-error' : '' }}">
                        <label for="Company" class="col-md-4 control-label">Company</label>
                        <div class="col-md-6">
                           
                            {{ Form::select('kode_company', $Company, null, ['class'=> 'form-control','required'=>'required']) }}
                            @if ($errors->has('kode_company'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_company') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="box-footer">
                    <div class="row pull-right">
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Create User</button>
                        </div>
                    </div>

                </div>

            </div>
            </form>
        </div>

    </div>
    <!-- /.box -->
@stop
