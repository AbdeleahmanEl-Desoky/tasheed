<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\BlogDescription;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(10);

        return view('dashboard.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $blog = Blog::create($request->only(['title', 'description']));

        // Handle blog descriptions and associated files
        if ($request->filled('blog_description')) {
            foreach ($request->input('blog_description') as $index => $description) {
                $blogDescription = BlogDescription::create([
                    'blog_id' => $blog->id,
                    'description' => $description,
                ]);

                // Handle file upload for each description
                if ($request->hasFile("blog_description_file.$index")) {
                    $blogDescription->addMedia($request->file("blog_description_file.$index"))
                                    ->toMediaCollection('blog_descriptions');
                }
            }
        }

        // Handle the main blog file
        if ($request->hasFile('blog')) {
            $blog->addMediaFromRequest('blog')->toMediaCollection('blog');
        }

        return redirect()->route('dashboard.blog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
       return $blog = Blog::find($id);

        return view('dashboard.blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $blog = Blog::find($id);
        $blogDescriptions = $blog->descriptions;
        return view('dashboard.blog.edit',compact('blog','blogDescriptions'));
    }

  /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, int $id)
    {
        $blog = Blog::find($id);

        // Update blog data
        $blog->update($request->only(['title', 'description']));

        // Handle the main blog file update
        if ($request->hasFile('blog')) {
            $blog->clearMediaCollection('blog'); // Clear old files
            $blog->addMediaFromRequest('blog')->toMediaCollection('blog');
        }

        // Handle blog descriptions and associated files
        if ($request->filled('blog_description')) {
            foreach ($request->input('blog_description') as $index => $description) {
                if (isset($request->description_ids[$index])) {
                    // Update existing blog descriptions
                    $blogDescription = BlogDescription::find($request->description_ids[$index]);
                    $blogDescription->update(['description' => $description]);
                } else {
                    // Create new blog descriptions if not exist
                    $blogDescription = BlogDescription::create([
                        'blog_id' => $blog->id,
                        'description' => $description,
                    ]);
                }

                // Handle file upload for each description
                if ($request->hasFile("blog_description_file.$index")) {
                    $blogDescription->clearMediaCollection('blog_descriptions'); // Clear old files
                    $blogDescription->addMedia($request->file("blog_description_file.$index"))
                                    ->toMediaCollection('blog_descriptions');
                }
            }
        }

        return redirect()->route('dashboard.blog.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $blog  = Blog::find($id);

        $blog->clearMediaCollection('blog');

        $blog->delete();

        return redirect()->route('dashboard.blog.index');
    }
}
