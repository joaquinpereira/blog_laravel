<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','excerpt','body','published_at','category_id','user_id'];

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

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopePublished($query){
        return $query->whereNotNull('published_at')
        ->where('published_at','<=', Carbon::now())
        ->orderBy('published_at', 'desc');
    }

    public function scopeAllowed($query){
        
        if(auth()->user()->hasRole('Admin')){
            return $query;
        }

        return $query->where('user_id', auth()->id());
    }

    public static function create(array $attributes = []){

        $attributes['user_id'] = auth()->id();
        
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

    public function isPublished(){
        return $this->published_at && $this->published_at < today();
    }

    public function viewType($home = null){

        if($this->photos->count() === 1):
            return 'posts.photo';
        elseif($this->photos->count() > 1):
            return $home == 'home' ? 'posts.carousel-preview' : 'posts.carousel';
        elseif ($this->iframe):
            return 'posts.iframe';
        else:
            return 'posts.text';
        endif;

    }
}
