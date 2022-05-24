<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact(['categories','tags']));
    }

    public function store(Request $request){

        $this->validate($request, ['title' => 'required|min:3']);
        
        $post = Post::create([
            'title' => $request->title,
        ]);
 
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact(['post','categories','tags']));
    }

    public function update(Post $post, PostFormRequest $request){

        $post->update($request->all());

        $post->syncTags($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash','La publicación ha sido actualizada');
    }

    public function destroy(Post $post){
        
        $post->delete();

        return redirect()->route('admin.posts.index', $post)->with('flash','La publicación ha sido eliminada');
    }

}
