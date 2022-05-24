<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category){
        
        return view('welcome',[
            'posts' => $category->posts()->paginate(10),
            'title' => "Publicaciones de la categoría '$category->name'"
        ]);
    }
}
