<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id'];

    protected $dates = ['published_at'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function create(array $attributes = [])
    {
        $post = static::query()->create($attributes);

        $post->generateSlug();

        return $post;
    }

    public function generateSlug()
    {
        $slug = str_slug($this->title);

        if ($this->whereSlug($slug)->exists()) {
            $slug .= '-' . $this->id;
        }

        $this->slug = $slug;
        $this->save();
    }

    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at < today();
    }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setCategoryIdAttribute($category_id)
    {
        $this->attributes['category_id'] = Category::find($cat = $category_id)
                                    ? $cat
                                    : Category::create(['name' => $cat])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function ($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
            ->where('published_at','<',Carbon::now())
            ->latest('published_at');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function viewType($view = '')
    {
        if ($this->photos->count() === 1) {
            return 'posts.photo';
        } elseif ($this->photos->count() > 1) {
            return 'posts.carousel' . $view;
        } elseif ($this->iframe) {
            return'posts.iframe';
        } else {
            return 'posts.text';
        }
    }
}
