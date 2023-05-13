<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Load the user's blogs and comments with their respective likes and dislikes
        $blogs = Blog::where('user_id', $user->id)->get();
        $comments = Comment::where('user_id', $user->id)->with('likes', 'dislikes')->get();

        // Count the number of blogs and comments
        $blogCount = $blogs->count();
        $commentCount = $comments->count();

        return view('dashboard', compact('user', 'blogCount', 'commentCount', 'blogs', 'comments'));
    }
}
