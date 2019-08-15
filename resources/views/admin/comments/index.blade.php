@extends('layouts.admin')

@section('content')


    @if(count($comments)> 0)

        <h1>Comments</h1>

    <table class="table table-hover">
        <thead>
          <tr>
            <th>Author</th>
            <th>E-mail</th>
            <th>Comment</th>
            <th></th>
          </tr>
        </thead>

        <tbody>

        @foreach($comments as $comment)

          <tr>
            <td>{{$comment->author}}</td>
            <td>{{$comment->email}}</td>
            <td>{{\Illuminate\Support\Str::words($comment->body, 2)}}</td>
            <td><a href="{{route('home.post', $comment->post->slug)}}"><button type="button" class="btn btn-primary btn-sm m-0">View Post</button></a></td>
            <td><a href="{{route('replies.show', $comment->id)}}"><button type="button" class="btn btn-info btn-sm m-0">View Replies</button></a></td>
            <td>
                @if ($comment->is_active == 1)

                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostsCommentsController@update', $comment->id]]) !!}

                    <input type="hidden" name="is_active" value="0">

                        <div class='form-group'>
                            {!! Form::submit('Un-approve', ['class' => 'btn btn-success  btn-sm m-0']) !!}
                        </div>

                    {!! Form::close() !!}

                    @else

                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostsCommentsController@update', $comment->id]]) !!}

                    <input type="hidden" name="is_active" value="1">

                    <div class='form-group'>
                        {!! Form::submit('Approve', ['class' => 'btn btn-success  btn-sm m-0']) !!}
                    </div>

                    {!! Form::close() !!}

                @endif
            </td>

            <td>
                {!! Form::open(['method' => 'DELETE', 'action' => ['PostsCommentsController@destroy', $comment->id]]) !!}

                    <div class='form-group'>
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger  btn-sm m-0']) !!}
                    </div>

                {!! Form::close() !!}
            </td>
          </tr>

        @endforeach

        </tbody>

      </table>

        @else

        <h1 class="text-center">No Comments</h1>

    @endif

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$comments->render()}}
        </div>
    </div>
@stop
