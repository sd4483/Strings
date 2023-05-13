<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Mail\NewCommentNotification;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Blog $blog)
    {
        $comment = new Comment;
        $comment->content = request('content');
        $comment->user_id = auth()->id();
        $comment->blog_id = $blog->id;
        $comment->save();
        return view('comments.comment', ['comment' => $comment])->render();
    }



    public function like(Comment $comment)
    {
        \Log::info('Like method executed. Comment ID: ' . $comment->id);
        $comment->increment('likes');
        return response()->json(['likes' => $comment->likes]);
    }

    public function dislike(Comment $comment)
    {
        \Log::info('Dislike method executed. Comment ID: ' . $comment->id);
        $comment->increment('dislikes');
        return response()->json(['dislikes' => $comment->dislikes]);
    }


    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
