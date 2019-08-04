@extends('layouts.admin')

@section('content')


    @if (Session::has('image_deleted'))

        <p class="alert alert-danger">{{session('image_deleted')}}</p>

    @endif

    <h1>Media</h1>

    @if ($photos)

        <table class="table table-hover">
            <thead>
              <tr>
                <th>Photo</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th></th>
              </tr>
            </thead>

        @foreach($photos as $photo)

            <tbody>
              <tr>
                <td><img height="150" src="{{$photo->file}}" alt="Images"></td>
                <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No Date'}}</td>
                <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No Date'}}</td>
                <td>
                    {!! Form::open(['action' => ['AdminMediaController@destroy', $photo->id], 'method' => 'DELETE']) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    </div>

                    {!! Form::close() !!}
                </td>
              </tr>
            </tbody>

        @endforeach

        </table>
    @endif
@stop
