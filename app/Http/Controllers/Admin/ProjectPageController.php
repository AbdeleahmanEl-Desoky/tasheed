<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPageRequest;
use App\Models\ProjectPage;
use Illuminate\Http\Request;

class ProjectPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = ProjectPage::first();

        return view('dashboard.project.index',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectPageRequest $request)
    {
        $about = ProjectPage::updateOrCreate(
            ['id' => $request->id],
            $request->except('file')
        );

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $about->clearMediaCollection('about_caver');

            // Then, add the new files
            $about->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_caver');
            });
        }

        return redirect()->route('dashboard.about.index');
    }






}
