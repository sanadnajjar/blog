@extends('layouts.admin')



@section('content')

    @if (Session::has('deleted_user'))

        <p class="alert alert-danger">{{session('deleted_user')}}</p>

    @elseif (Session::has('updated_user'))

        <p class="alert alert-success">{{session('updated_user')}}</p>

    @elseif (Session::has('user_created'))

        <p class="alert alert-success">{{session('user_created')}}</p>

    @endif

    <h1>Users</h1>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @if ($users)

            @foreach($users as $user)
        <tr>
            <td class="text-center"><img height="50" src="{{$user->photo()->exists() ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="Profile Picture"></td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td><a href="{{url('admin/users/' . $user->id . '/edit')}}"><button type="button" class="btn btn-primary btn-sm m-0">Edit</button></a></td>
            <td>
                {!! Form::open(['action' => ['AdminUsersController@destroy', $user->id], 'method' => 'DELETE']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm m-0']) !!}
                </div>

                {!! Form::close() !!}
            </td>
        </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$users->render()}}
        </div>
    </div>

@stop
