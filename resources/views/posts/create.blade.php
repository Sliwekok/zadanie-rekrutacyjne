@extends('layouts.layout')

@section('content')

<div class="row">
<div class="col-8 offset-2">
    <form action="{{url("/post/createPost")}}" method="POST">
        @csrf
        <p><h2>Create post</h2></p>    
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <input name="content" type="text" class="form-control" id="content" aria-describedby="Describe your opinion more" placeholder="Description">
            <small id="contentHelp" class="form-text text-muted">Describe your opinion more.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>

@endsection