@extends('layouts.admin')


@section('content')

    <h1>Create User</h1>

    <div class="row">

    {!! Form::open(['action' => 'AdminUsersController@store', 'method' => 'post', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-mail:', ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role:', ['class' => 'control-label']) !!}
        {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status:', ['class' => 'control-label']) !!}
        {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), 0, ['class' => 'form-control']) !!}
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
        {!! Form::submit('Create User', ['class' => 'btn btn-primary col-sm-2']) !!}
    </div>

    {!! Form::close() !!}

    </div>

    <div class="row">
        @include('includes.form-error')
    </div>

@stop
