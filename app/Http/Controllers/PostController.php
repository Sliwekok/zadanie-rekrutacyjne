<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public $url;    
    public function __construct(){
        $this->url = env('API_URL');
        dd($this->url);

    }

    // find all posts
    public function showAll(){
        // fetch all posts from api
        $url = $this->url . "post/";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", $url);
        // transform to json format, on paginate function it returns to colletion format
        $post = json_decode($response->getBody());
        // transform json to collection to use paginator
        $paginated = $this->paginate($post)->setPath('/post');
        return view('posts/index',[
            'posts' => $paginated,
            'title' => "All posts"
        ]);
    }

    // show single post
    public function show($id){
        // fetch all posts from api
        $url = $this->url . "post/". $id;
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", $url);
        // paginate comments on single post, set path to post
        // returned array gives 2 dimensional array - one for post data, second for post comments, 0 - post, 1 - comments
        $post = json_decode($response->getBody());
        $comments = $this->paginate($post[1])->setPath("/post/$id");
        return view('posts/post',[
            'post'      => $post[0],
            'comments'  => $comments,
            'title'     => $post[0]->title,
        ]);
    }

    // create post view
    public function create(){
        return view('posts/create',[
            'title' => "Create new post"
        ]);
    }

    // send request to API to create a new post
    public function createPost(Request $request){
        $url = $this->url . "post/create";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("POST", $url, [
            'form_params' => array(
                'author'    => Auth::user()->name,
                'title'     => $request->title,
                'content'   => $request->content,
            )
        ]);
        return redirect('post/');
    }

    // add comment to current
    public function addComment($id, Request $request){
        $url = $this->url . "post/$id/comment";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("POST", $url, [
            'form_params' => array(
                'author'    => Auth::user()->name,
                'post_id'   => $id,
                'content'   => $request->content,
            )
        ]);
        return back();
    }

    // show edit view
    // create post view
    public function edit($id){
        // fetch all posts from api
        $url = $this->url . "post/". $id;
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", $url);
        // returned array gives 2 dimensional array - one for post data, second for post comments, 0 - post, 1 - comments
        // but we need only posts
        $post = json_decode($response->getBody());
        return view("posts/edit",[
            'post'      => $post[0],
            'title'     => $post[0]->title,
        ]);
    }

    // send request to API to update post
    public function update($id, Request $request){
        $url = $this->url . "post/$id/update";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("POST", $url, [
            'form_params' => array(
                'author'    => Auth::user()->name,
                'title'     => $request->title,
                'content'   => $request->content,
            )
        ]);
        return redirect("post/$id");
    }

    // send request to API to delete post
    public function delete($id){
        $url = $this->url . "post/$id/delete";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("DELETE", $url);
        return redirect("post");
    }

    // transform json data to paginated collection
    private function paginate($items, $perPage = 30, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
