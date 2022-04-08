@extends('layouts.layout')

@section('content')

@foreach ($posts as $post)
    <div class="row posts">
        <div class="col-8 offset-2">
            <div class="row">
                <div class="col-12">
                    <span class="title"><a href="{{url('post/'. $post->id)}}">{{$post->title}}</a></span>
                    <span class="author">{{$post->author}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <span class="content">{{$post->content}}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{$posts->links()}}

@endsection