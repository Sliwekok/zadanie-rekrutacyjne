@extends('layouts.layout')

@section('content')

<div class="row">
<div class="col-8 offset-2">
    <form action="{{url("post/$post->id/update")}}" method="POST">
        @csrf
        <p><h2>Edit post</h2></p>    
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post->title}}" id="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <input name="content" type="text" value="{{$post->content}}" class="form-control" id="content" aria-describedby="Describe your opinion more" placeholder="Description">
            <small id="contentHelp" class="form-text text-muted">Describe your opinion more.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>

@endsection