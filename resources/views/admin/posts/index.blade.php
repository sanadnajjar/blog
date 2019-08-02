@extends('layouts.admin')



@section('content')

    @if (Session::has('deleted_post'))

        <p class="alert alert-danger">{{session('deleted_post')}}</p>

    @elseif (Session::has('updated_post'))

        <p class="alert alert-success">{{session('updated_post')}}</p>

    @elseif (Session::has('post_created'))

        <p class="alert alert-success">{{session('post_created')}}</p>

    @endif

    <h1>Posts</h1>

    <table class="table table-hover">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>

            @if ($posts)

                @foreach($posts as $post)
                    <tr>
                        <td class="text-center"><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt="Post Image"></td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td><a href="{{url('admin/posts/' . $post->id . '/edit')}}"><button type="button" class="btn btn-primary btn-sm m-0">Edit</button></a></td>
                        <td>
                            {!! Form::open(['action' => ['AdminPostsController@destroy', $post->id], 'method' => 'DELETE']) !!}

                            <div class="form-group">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm m-0']) !!}
                            </div>

                            {!! Form::close() !!}
                        </td>
{{--                        <td><button type="button" class="btn btn-danger btn-sm m-0">Delete</button></td>--}}
                    </tr>
                @endforeach
            @endif

        </tbody>
      </table>

@stop
