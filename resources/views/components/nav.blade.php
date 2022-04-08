<div class="row" style="padding: 0px; margin:0px;">
<nav class="col-12 navbar navbar-default navbar">
    <div class="col-3 text-center" id="logo"><a href="{{url('/post/')}}"><h1>Posts</h1></a></div>
    <div class="col-4 text-center d-inline-flex">
        <div class="col-6"><a href="{{url('/post/create')}}">Create post</a></div>
        <div class="col-6"><a href="{{url('/user/')}}"><span>{{Auth::user()->name}}</span></a></div>
    </div>
</nav>
</div>