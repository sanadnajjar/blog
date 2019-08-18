@if (Session::has('comment_posted'))
    <div class="alert alert-success col-sm-6">
        <p class="text-center">{{session('comment_posted')}}</p>
    </div>
@endif

