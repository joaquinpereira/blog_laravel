<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        return view('welcome',[
            'posts' => $tag->posts()->paginate(10),
            'title' => "Publicaciones de la etiqueta '$tag->name'"
        ]);
    }
}
