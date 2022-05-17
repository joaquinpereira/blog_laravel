<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $posts = Post::orderBy('published_at', 'desc')->get();    
        return view('welcome', compact('posts'));
    }
}
