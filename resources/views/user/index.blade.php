@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-8">
        <p>You're logged as {{$user}}</p>
        <form method="post" action="{{url("logout")}}">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
</div>

@endsection
