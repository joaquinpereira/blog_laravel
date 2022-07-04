<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category){

        $posts = $category->posts()->published()->paginate(15);
        
        if(request()->wantsJson()){
            return $posts;
        }
        
        return view('pages.home',[
            'posts' => $posts,
            'title' => "Publicaciones de la categoría '$category->name'"
        ]);
    }
}
