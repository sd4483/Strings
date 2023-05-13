<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('published', true)->get();
        return view('welcome', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required',
            'featured_image' => 'nullable|image',
        ]);
        
        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->slug = Str::slug($validatedData['title']); // Generate slug from title
        $blog->content = $validatedData['content'];
        
        // Handling the image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $blog->featured_image = $imageName;
        } 
        
        $blog->status = $request->filled('published') ? 'published' : 'draft'; // Check if "published" field is filled
        $blog->user_id = Auth::id();

        // Save the blog to the database
        $blog->save();

        // Split the categories string by commas
        $categoryNames = explode(',', $request->input('categories'));

        // Loop through each category name
        foreach ($categoryNames as $categoryName) {
            // Trim whitespace
            $categoryName = strtolower(trim($categoryName));

            // Find the category by its name or create a new one if it does not exist
            $category = Category::firstOrCreate(['name' => $categoryName]);

            // Attach the category to the blog
            $blog->categories()->attach($category);
        }

        return redirect()->route('welcome');      
    }

    /**
     * Display the specified resource.
     */

    
     public function show(string $slug)
     {   
         $blog = Blog::where('slug', $slug)->with(['comments' => function ($query) {
             $query->orderBy('created_at', 'desc');
         }])->firstOrFail();
     
         $latestBlogs = Blog::latest()->limit(5)->get();
         $topCategories = Category::getTopCategories(5); 
         
         return view('blogs.show', [
             'blog' => $blog,
             'latestBlogs' => $latestBlogs,
             'topCategories' => $topCategories,
         ]);
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
