@extends('layouts.admin')

@section('content')

    @if (Session::has('updated_category'))
        <div class="alert alert-success col-sm-6">
            <p class="text-center">{{session('updated_category')}}</p>
        </div>
    @elseif (Session::has('category_deleted'))
        <div class="alert alert-danger col-sm-6">
            <p class="text-center">{{session('category_deleted')}}</p>
        </div>
    @endif

    <h1>Categories</h1>


    <div class="col-sm-6">
        {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class='form-group'>
                {!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    @if($categories)

    <div class="col-sm-6">
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)

              <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
                <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No Date'}}</td>
                <td><a href="{{url('admin/categories/' . $category->id . '/edit')}}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td>
                    {!! Form::open(['action' => ['AdminCategoriesController@destroy', $category->id], 'method' => 'DELETE']) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        </div>

                    {!! Form::close() !!}
                </td>
              </tr>
            </tbody>

            @endforeach

          </table>
    </div>

    @endif

@stop
