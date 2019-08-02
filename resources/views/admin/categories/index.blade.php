@extends('layouts.admin')

@section('content')

    @if (Session::has('updated_category'))

        <p class="alert alert-success">{{session('updated_category')}}</p>

    @elseif (Session::has('category_deleted'))

        <p class="alert alert-danger">{{session('category_deleted')}}</p>

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
                <th>Created date</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)

              <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
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
