@extends('layouts.admin')


@section('content')

    <h1>Edit Users</h1>

    <div class="row">
        <div class="col-sm-3">

            <img src="{{$user->photo()->exists() ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="Profile Picture" class="img-responsive img-rounded">

        </div>

        <div class="col-sm-9">

            {!! Form::model($user, ['action' => ['AdminUsersController@update', $user->id] , 'method' => 'patch', 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role:', ['class' => 'control-label']) !!}
                {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status:', ['class' => 'control-label']) !!}
                {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:', ['class' => 'control-label']) !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Edit User', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

        <div class="row">

            @include('includes.form-error')

        </div>


@stop
