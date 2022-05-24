<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','excerpt','body','published_at','category_id'];

    protected $dates = ['published_at'];

    public static function boot(){
        parent::boot();

        static::deleting(function ($post){
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function getRouteKeyName(){
        return 'url';
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function scopePublished($query){
        return $query->whereNotNull('published_at')
        ->where('published_at','<=', Carbon::now())
        ->orderBy('published_at', 'desc');
    }

    public static function create(array $attributes = []){
        $post = static::query()->create($attributes);

        $post->generateUrl();

        return $post;
    }

    public function generateUrl(){
        $url = Str::slug($this->title);

        if(static::where('url',$url)->exists()){
            $url = "{$url}-{$this->id}"; 
        }

        $this->url = $url;

        $this->save();
    }

    public function setPublishedAtAttribute($published_at){
        $this->attributes['published_At'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setCategoryIdAttribute($category){
        $this->attributes['category_id'] = Category::find($category) ? $category : 
            Category::create(['name' => $category])->id;
    }

    public function syncTags($tags){
        $tagIds = collect($tags)->map(function ($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
              
        return $this->tags()->sync($tagIds);
    }
}
