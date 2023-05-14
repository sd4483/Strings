<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'categories')->paginate(9);

        $topCategories = Category::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->take(5)
            ->get();

        return view('welcome', compact('blogs', 'topCategories'));
    }
}
