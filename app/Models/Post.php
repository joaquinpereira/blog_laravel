<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','url','excerpt','body','published_at','category_id'];

    protected $dates = ['published_at'];

    public function getRouteKeyName(){
        return 'title';
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query){
        return $query->whereNotNull('published_at')
        ->where('published_at','<=', Carbon::now())
        ->orderBy('published_at', 'desc');
    }
}
