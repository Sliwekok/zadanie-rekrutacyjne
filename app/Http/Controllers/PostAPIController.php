<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class PostAPIController extends Controller
{

    /*********
     * 
     * This is API only controller
     * It handles everything about Posts
     * Moreover, it handles creating comments to post, since it's based on post ID
     * 
     */

    // default controller view, showing all posts
    public function showAll(){
        $posts = Post::all();
        return $posts;
    }

    // fetch single post via id
    public function show($id){
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
        return [$post, $comments];
    }

    // create a new post
    public function create(Request $request){
        // validate request
        if(!$this->validateRequest($request)) return "bad data provided";
        // create model 
        $post = new Post;
        // pass data
        $post->author   = $request->author;
        $post->title    = $request->title;
        $post->content  = $request->content;
        // save in db
        if($post->save()) return "success";
        else return "error";
    }

    // update data in single post
    public function update($id, Request $request){
        // validate request
        if(!$this->validateRequest($request)) return "bad data provided";
        // create model
        $post = Post::find($id);
        // pass data
        $post->author   = $request->author;
        $post->title    = $request->title;
        $post->content  = $request->content;
        // save changes
        if($post->update()) return "success";
        else return "error";
    }

    // delete post from db
    public function delete($id){
        $post = Post::find($id);
        if($post->delete()) return "success";
        else return "error";
    }

    // create comment to post
    public function addComment($id, Request $request){
        // validate data
        $validatedData = Validator::make($request->all(),[
            'author'    => ['required', 'max:255', 'string'],
            'post_id'   => ['required', 'max:32', 'integer'],
            'content'   => ['required', 'max:2048', 'string'],
        ]);
        // create Comment model
        $comment = new Comment;
        // pass data
        $comment->author   = $request->author;
        $comment->post_id  = $request->post_id;
        $comment->content  = $request->content;
        // save in db
        if($comment->save()) return "success";
        else return "error";
    }

    // validate request parameters
    private function validateRequest($data){
        $validatedData = Validator::make($data->all(),[
            'author'    => ['required', 'max:255', 'string'],
            'title'     => ['required', 'max:255', 'string'],
            'content'   => ['required', 'max:2048', 'string'],
        ]);
        // upon any validator fail return false 
        if($validatedData->fails()) return false;
        return true;
    }
}