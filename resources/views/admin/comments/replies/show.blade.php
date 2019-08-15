@extends('layouts.admin')

@section('content')


    @if(count($replies) > 0)

        <h1>replies</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Author</th>
                <th>E-mail</th>
                <th>reply</th>
            </tr>
            </thead>

            @foreach($replies as $reply)

                <tbody>

                <tr>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{\Illuminate\Support\Str::words($reply->body, 2)}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->slug)}}"><button type="button" class="btn btn-info btn-sm m-0">View Post</button></a></td>
                    <td>
                        @if ($reply->is_active == 1)

                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class='form-group'>
                                {!! Form::submit('Un-approve', ['class' => 'btn btn-success  btn-sm m-0']) !!}
                            </div>

                            {!! Form::close() !!}

                        @else

                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class='form-group'>
                                {!! Form::submit('Approve', ['class' => 'btn btn-success  btn-sm m-0']) !!}
                            </div>

                            {!! Form::close() !!}

                        @endif
                    </td>

                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}

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

        <h1 class="text-center">No Replies</h1>

    @endif
@stop
