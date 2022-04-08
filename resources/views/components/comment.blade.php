<div class="row">
<div class="col-12">
    <form class="col-12" id="addComment" action="{{url()->current() . "/comment"}}" method="POST">
        <p><h2>Comment post</h2></p>
        @csrf
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
<div class="col-12">
    @foreach($comments as $comment)
        <div class="row comment">
            <div class="row d-inline-flex">
                <div class="col-12 d-inline-flex align-baseline">
                    <p class="author">{{$comment->author}}</p>
                    <p class="timestamp">{{Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</p>
                </div>
                <div class="col-12">
                    <p class="content">{{$comment->content}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>