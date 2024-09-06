<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPageRequest;
use App\Models\BlogPage;
use App\Models\MeetTeamPage;
use App\Models\ProjectPage;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = BlogPage::first();

        return view('dashboard.blog.caver',compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectPageRequest $request)
    {
        $about = BlogPage::updateOrCreate(
            ['id' => $request->id],
            $request->except('file')
        );

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $about->clearMediaCollection('blog_caver');

            // Then, add the new files
            $about->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('blog_caver');
            });
        }

        return redirect()->route('dashboard.blog.caver');
    }






}
