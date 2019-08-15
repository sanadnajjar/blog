@extends('layouts.admin')


@section('content')

    @include('includes.tinyeditor')

    <h1>Edit Post</h1>

    <div class="row">

        <div class="col-sm-3">
            <img src="{{$post->photo->exists() ? $post->photo->file : 'http://placehold.it/400x400'}}" alt="Post Image" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">

        {!! Form::model($post, ['action' => ['AdminPostsController@update', $post->id] , 'method' => 'patch', 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:', ['class' => 'control-label']) !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:', ['class' => 'control-label']) !!}
            {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Description:', ['class' => 'control-label']) !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::submit('Edit Post', ['class' => 'btn btn-primary col-sm-2 ']) !!}
        </div>

        {!! Form::close() !!}

{{--        {!! Form::open(['action' => ['AdminPostsController@destroy', $post->id], 'method' => 'DELETE']) !!}--}}

{{--        <div class="form-group">--}}
{{--            {!! Form::submit('Delete Post', ['class' => 'btn btn-danger col-sm-2']) !!}--}}
{{--        </div>--}}

{{--        {!! Form::close() !!}--}}

    </div>
        </div>

    <div class="row">

        @include('includes.form-error')

    </div>

@stop
