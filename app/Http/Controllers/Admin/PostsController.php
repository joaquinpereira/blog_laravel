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

        $this->validate($request, ['title' => 'required|unique:posts,title']);
        
        $post = Post::create([
            'title' => $request->title,
            'url' => Str::slug($request->title,'_'),
        ]);
 
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact(['post','categories','tags']));
    }

    public function update(Post $post, PostFormRequest $request){

        $post->title = $request->title;
        $post->url = Str::slug($request->title,'_');
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        $post->published_at = $request->published_at;
        $post->category_id = $request->category;
        $post->save();
        
        $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash','Tu publicación ha sido actualizada');
    }

}
