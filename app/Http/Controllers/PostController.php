<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public $url;    
    public function __construct(){
        $this->url = 'http://zadanie.test/api/';
    }

    // find all posts
    public function showAll(){
        $posts = Post::all()->paginate(30);
        return view('posts/index',[
            'posts' => $posts,
            'title' => "All posts"
        ]);
    }

    // show single post
    public function show($id){
        $post = Post::find($id);
        return view('posts/post',[
            'post' => $post,
            'title'=> $post->title
        ]);
    }

    // create post
    public function create(){
        return view('posts/create',[
            'post' => $post,
            'title'=> "Create new post"
        ]);
    }

    // edit post
    public function edit($id){
        $post = Post::find($id);
        return view('posts/create',[
            'post' => $post,
            'title'=> "Create new post"
        ]);
    }

    // get data from API and return json object
    private function getAPIContent($url){
        $json = json_decode(file_get_contents($url), true);
        return $json;
    }
}
