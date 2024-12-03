<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
 public function createPostForm () {
    return view('create_post');
 }

 
 public function createPost (Request $request){
    $incomingData = $request->validate([
        'title' => 'required',
        'body' => 'required'
    ]);

    $incomingData['title'] = strip_tags($incomingData['title']);
    $incomingData['body'] = strip_tags($incomingData['body']);

    $incomingData['user_id'] = auth()->id();

    Post::create($incomingData);
    
    return redirect('/');

 }

}
