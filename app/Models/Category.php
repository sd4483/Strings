<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function blogs() 
    {
        return $this->belongsToMany(Blog::class);
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public static function getTopCategories($limit)
    {
        return Category::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->limit($limit)
            ->get();
    }

}
