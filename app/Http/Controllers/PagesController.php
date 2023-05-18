<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function spa(){
        return view('pages.spa');
    }

    public function home(){
        $query = Post::published();

        if(request('month')){
            $query->whereMonth('published_at', request('month'));
        }

        if(request('year')){
            $query->whereYear('published_at', request('year'));
        }

        $posts = $query->paginate(15);

        if(request()->wantsJson()){
            return $posts;
        }

        return view('pages.home', compact('posts'));
    }

    public function about(){
        return view('pages.about');
    }

    public function archive(){

        DB::statement("SET lc_time_names = 'es_ES'");

        $data = [
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::latest()->take(7)->get(),
            'posts' => Post::latest('published_at')->take(7)->get(),
            'archive' => Post::byYearAndMonth()->get()
        ];

        if(request()->wantsJson()){
            return $data;
        }

        return view('pages.archive', $data);
    }

    public function contact(){
        return view('pages.contact');
    }
}
