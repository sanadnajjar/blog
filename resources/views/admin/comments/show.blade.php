@extends('layouts.admin')

@section('content')


    @if(count($comments) > 0)

        <h1>Comments</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Author</th>
                <th>E-mail</th>
                <th>Comment</th>
            </tr>
            </thead>

            @foreach($comments as $comment)

            <tbody>

                <tr>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{\Illuminate\Support\Str::words($comment->body, 2)}}</td>
                    <td><a href="{{route('home.post', $comment->post->id)}}"><button type="button" class="btn btn-info btn-sm m-0">View</button></a></td>
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

            </tbody>

                @endforeach

        </table>

    @else

        <h1 class="text-center">No Comments</h1>

    @endif
@stop
