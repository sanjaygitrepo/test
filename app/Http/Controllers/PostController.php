<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
  
        $post = Post::create([
            'title' => $request->title,
            'user_id' => 1,
            'body' => $request->body
        ]);
        
        return response()->json(['message'=>'success','post'=>$post],200);
    }

    public function index()
    {
  
        $posts = Post::all();
        
        return response()->json(['message'=>'success','posts'=>$posts],200);
    }    
}
