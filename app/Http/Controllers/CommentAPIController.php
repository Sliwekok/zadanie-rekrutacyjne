<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentAPIController extends Controller
{

    /*********
     * 
     * This is API only controller
     * It handles everything about comments, except creating (It is in PostAPIController)
     * 
     */


    // show all comments
    public function showAll(){
        $comments = Comment::all();
        return $comments;
    }

    // show single comment via id
    public function show($id){
        $comment = Comment::find($id);
        return $comment;
    }

    // update comment
    public function update($id, Request $request){
        // validate request
        $validatedData = Validator::make($request->all(),[
            'author'    => ['required', 'min:4', 'max:255', 'string'],
            'post_id'   => ['required', 'min:1', 'max:255', 'string'],
            'content'   => ['required', 'min:10', 'max:2048', 'string'],
        ]);
        // upon any validator fail return false 
        if($validatedData->fails()) return "bad data provided";
        // create model
        $comment = Comment::find($id);
        // pass data
        $comment->author   = $request->author;
        $comment->post_id  = $request->post_id;
        $comment->content  = $request->content;
        // save changes
        if($comment->update()) return "success";
        else return "error";
    }

    // delete comment from db
    public function delete($id){
        $comment = Comment::find($id);
        if($comment->delete()) return "success";
        else return "error";
    }

}
