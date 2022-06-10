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
        $posts = Post::allowed()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request){

        $this->authorize('create', new Post());

        $this->validate($request, ['title' => 'required|min:3']);
        
        $post = Post::create($request->only('title'));
 
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post){

        $this->authorize('update',$post);

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),            
            'categories' => Category::all(),            
        ]);
    }

    public function update(Post $post, PostFormRequest $request){

        $this->authorize('update',$post);

        $post->update($request->all());

        $post->syncTags($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash','La publicación ha sido actualizada');
    }

    public function destroy(Post $post){

        $this->authorize('delete',$post);
        
        $post->delete();

        return redirect()->route('admin.posts.index', $post)->with('flash','La publicación ha sido eliminada');
    }

}
