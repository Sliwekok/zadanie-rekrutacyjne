@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-8 offset-2">
        <div id="post" class="d-inline-flex col-12">
            <div class="col-10" id="content">
                <div class="row col-12" id="title"><p>{{$post->title}}</p></div>
                <div class="row col-12" id="content"><p>{{$post->content}}</p></div>
            </div>
            <div class="col-2" id="author">
                <p>Author: {{$post->author}}</p>
                <p class="text-white"><a class="text-white" href="{{url()->current() . '/edit'}}"><button class="btn btn-primary text-white">Edit post</a></button></p>
                <p class="text-white">
                    <form id="deletePost" method="post" action="{{url()->current(). "/delete"}}">
                        @csrf
                        <button class="btn btn-danger text-white" type="submit">Delete post</a></button>
                    </form>
                </p>
            </div>
        </div>
        <div id="comments" class="col-12">
            @include('components/comment')
        </div>
    </div>
</div>

@endsection