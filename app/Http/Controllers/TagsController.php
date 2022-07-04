<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->published()->paginate(15);
        
        if(request()->wantsJson()){
            return $posts;
        }

        return view('pages.home',[
            'posts' => $posts,
            'title' => "Publicaciones de la etiqueta '$tag->name'"
        ]);
    }
}
