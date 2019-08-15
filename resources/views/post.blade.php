@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->

    <p>{{$post->body}}</p>

    <hr>

    @if (Session::has('comment_posted'))
        <p class="alert alert-success">{{session('comment_posted')}}</p>
    @endif

    <!-- Blog Comments -->

    @if(Auth::check())

    <!-- Comments Form -->
        <div class="well">
            {!! Form::open(['method' => 'POST', 'action' => 'PostsCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">

                <div class="form-group">
                    <h4>{!! Form::label('body','Leave a Comment:', ['class' => 'control-label']) !!}</h4>
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::submit('Submit Comment', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>

    @endif

    <hr>

    <!-- Posted Comments -->

    @if(count($comments) > 0)

        @foreach($comments as $comment)
    <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>

                    <div class="comment-reply-container">

                        <button class="toggle-reply btn btn-primary btn-sm m-0 pull-right">Reply</button>

                        <div style="display: none" class="comment-reply col-sm-9">

                            {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}

                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                            <div class="form-group">
                                {!! Form::label('body', 'Reply:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 1]) !!}
                            </div>

                            <div class='form-group'>
                                {!! Form::submit('Submit Reply', ['class' => 'btn btn-primary btn-sm m-0']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>

            <!-- Nested Comment -->

            @if(count($comment->replies))

                @foreach($comment->replies as $reply)

                    @if($reply->is_active == 1)


                        <div style="margin-top: 30px" class="media">
                            <a class="pull-left" href="#">
                                <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                <p>{{$reply->body}}</p>
                            </div>
                            <br>
                            <div class="comment-reply-container">

                                <button class="toggle-reply btn btn-primary btn-sm m-0 pull-right">Reply</button>

                                <div style="display: none" class="comment-reply col-sm-9">

                                {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}

                                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                    <div class="form-group">
                                        {!! Form::label('body', 'Reply:', ['class' => 'control-label']) !!}
                                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 1]) !!}
                                    </div>

                                    <div class='form-group'>
                                        {!! Form::submit('Submit Reply', ['class' => 'btn btn-primary btn-sm m-0']) !!}
                                    </div>

                                {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                            @else

                                <h1 class="text-center">No Replies</h1>

                            @endif
                @endforeach
            @endif
                </div>
            </div>

        @endforeach
    @endif


@stop

@section('scripts')

    <script>
        $(".comment-reply-container .toggle-reply").click(function () {

            $(this).next().slideToggle("slow");

        })
    </script>

@stop
