<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\BlogDescription;
use Illuminate\Http\Request;

class BlogDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($blog_id)
    {
        $blogs = BlogDescription::where('blog_id',$blog_id)->paginate(10);

        return view('dashboard.blog.description.index',compact('blogs','blog_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($blog_id)
    {
        return view('dashboard.blog.description.create',compact('blog_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $blog = BlogDescription::create([
            'description' => $request->description,
            'blog_id'=> $request->blog_id
        ]);


        // Handle the main blog file
        if ($request->hasFile('blog_descriptions')) {
            $blog->addMediaFromRequest('blog_descriptions')->toMediaCollection('blog_descriptions');
        }

        return redirect()->route('dashboard.blog.index');
    }


    public function show(int $id)
    {
       return $blog = BlogDescription::find($id);

        return view('dashboard.blog.description.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $description = BlogDescription::find($id);

        return view('dashboard.blog.description.edit',compact('description'));
    }

  /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $blog = BlogDescription::find($id);

        // Update blog data
        $blog->update($request->only(['description']));

        // Handle the main blog file update
        if ($request->hasFile('blog_descriptions')) {
            $blog->clearMediaCollection('blog_descriptions'); // Clear old files
            $blog->addMediaFromRequest('blog_descriptions')->toMediaCollection('blog_descriptions');
        }



        return redirect()->route('dashboard.blog.index',);
    }


/**
 * Remove the specified resource from storage.
 */
public function destroy(int $id)
{
    // Find the blog description by its ID
    $blog = BlogDescription::find($id);

    // Check if the blog description exists
    if ($blog) {
        // Check if the blog has any media in the 'blog_descriptions' collection before clearing it
        if ($blog->hasMedia('blog_descriptions')) {
            $blog->clearMediaCollection('blog_descriptions');
        }

        // Delete the blog description
        $blog->delete();

        // Redirect with a success message
        return redirect()->route('dashboard.blog.index')->with('success', 'Blog description deleted successfully.');
    }

    // Redirect with an error message if the blog description was not found
    return redirect()->route('dashboard.blog.index')->with('error', 'Blog description not found.');
}

}
