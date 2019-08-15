@extends('layouts.admin')

@section('content')


    @if (Session::has('image_deleted'))

        <p class="alert alert-danger">{{session('image_deleted')}}</p>

    @endif

    <h1>Media</h1>

    @if ($photos)

        <form action="delete/media" method="post" class="form-inline">
            @csrf
            {{csrf_field()}}
            {{method_field('delete')}}

            <div class="form-group">
                <select name="checkBoxArray" id="" class="form-control">
                    <option value="">Delete</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="delete_all" class="btn btn-primary btn-sm m-0">
            </div>


        <table class="table table-hover">
            <thead>
              <tr>
                <th><input type="checkbox" id="options"></th>
                <th>Photo</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th></th>
              </tr>
            </thead>

        @foreach($photos as $photo)

            <tbody>
              <tr>
                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                <td><img height="150" src="{{$photo->file}}" alt="Images"></td>
                <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No Date'}}</td>
                <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No Date'}}</td>
                <td>
                    <input type="hidden" name="photo" value="{{$photo->id}}">

                    <div class="form-group">
                        <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                    </div>
                </td>
              </tr>
            </tbody>

        @endforeach

        </table>
        </form>
    @endif

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$photos->render()}}
        </div>
    </div>
@stop

@section('scripts')

    <script>
        $(document).ready(function () {

            $('#options').click(function () {

                if (this.checked){

                    $('.checkBoxes').each(function () {

                        this.checked = true;

                    })
                }else{

                    $('.checkBoxes').each(function () {

                        this.checked = false;

                    })

                }

            })

        })
    </script>

@stop
