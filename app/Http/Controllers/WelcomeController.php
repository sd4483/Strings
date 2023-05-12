<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;


class WelcomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'categories')->get();

        return view('welcome', compact('blogs'));
    }
}
