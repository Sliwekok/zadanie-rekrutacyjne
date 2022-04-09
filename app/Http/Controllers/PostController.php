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
        $this->url = 'http://zadanie.test/api/';
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
        $post = json_decode($response->getBody());
        // returned array gives 2 dimensional array - one for post data, second for post comments, 0 - post, 1 - comments
        return view('posts/post',[
            'post'      => $post[0],
            'comments'  => $post[1],
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
    // transform json data to paginated collection
    private function paginate($items, $perPage = 30, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
