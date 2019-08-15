@extends('layouts.admin')


@section('content')


    @include('includes.tinyeditor')

    <h1>Create Post</h1>

    <div class="row">

        {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category:', ['class' => 'control-label']) !!}
                {!! Form::select('category_id', ['' => 'Choose Category'] + $categories, null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:', ['class' => 'control-label']) !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Description:', ['class' => 'control-label']) !!}
                {!! Form::textarea('body', null, [ 'class' => 'form-control']) !!}
            </div>

            <div class='form-group'>
                {!! Form::submit('Create Post', ['class' => 'btn btn-primary col-sm-2']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <div class="row">
        @include('includes.form-error')
    </div>

@stop
