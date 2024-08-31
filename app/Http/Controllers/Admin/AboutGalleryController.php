<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\AboutGallery;
use App\Models\Benefit;
use Illuminate\Http\Request;

class AboutGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = AboutGallery::paginate(10);

        return view('dashboard.about.gallery.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.about.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $gallery = AboutGallery::create($request->except('file'));

        if ($request->hasFile('file'))
        {
            $gallery->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('gallery');
            });
        }

        return redirect()->route('dashboard.about.galleries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $gallery = AboutGallery::find($id);

        return view('dashboard.about.gallery.show',compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $gallery = AboutGallery::find($id);

        return view('dashboard.about.gallery.edit',compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, int $id)
    {
        $gallery = AboutGallery::find($id);

        if ($request->hasFile('file'))
        {
            $gallery->clearMediaCollection('gallery');

            $gallery->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('gallery');
            });
        }

        $gallery->update($request->except('file'));

        return redirect()->route('dashboard.about.galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $gallery  = AboutGallery::find($id);

        $gallery->clearMediaCollection('gallery');

        $gallery->delete();

        return redirect()->route('dashboard.about.galleries.index');
    }
}
