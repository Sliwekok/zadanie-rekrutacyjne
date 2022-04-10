<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public $url;    
    public function __construct(){
        $this->url = 'http://zadanie.test/api/';
    }
    
    // send request to API to delete post
    public function delete($id){
        $url = $this->url . "comment/$id/delete";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("DELETE", $url);
        return redirect("post");
    }
}
