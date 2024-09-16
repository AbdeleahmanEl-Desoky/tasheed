<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\AboutVisionRequest;
use App\Http\Requests\MissionRequest;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\AboutMission;
use App\Models\AboutVision;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        $aboutGallery = AboutGallery::first();
        return view('dashboard.about.index',compact('about','aboutGallery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        $about = About::updateOrCreate(
            ['id' => $request->id],
            $request->except(['file','home_about'])
        );

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $about->clearMediaCollection('about_caver');

            // Then, add the new files
            $about->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_caver');
            });
        }

        $aboutGallery = AboutGallery::first();

        if ($request->hasFile('home_about')) {

            $aboutGallery->clearMediaCollection('gallery');

            $aboutGallery->addMultipleMediaFromRequest(['home_about'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('gallery');
            });
        }

        return redirect()->route('dashboard.about.index');
    }


    public function visionIndex()
    {
        $vision = AboutVision::first();

        return view('dashboard.about.vision',compact('vision'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function visionStore(AboutVisionRequest $request)
    {
        $vision = AboutVision::updateOrCreate(
            ['id' => $request->id],
            $request->except('image','file')
        );

        if ($request->hasFile('image')) {
            // First, clear any existing media if you're updating
            $vision->clearMediaCollection('about_vision');

            // Then, add the new files
            $vision->addMultipleMediaFromRequest(['image'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_vision');
            });
        }

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $vision->clearMediaCollection('about_vision_file');

            // Then, add the new files
            $vision->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_vision_file');
            });
        }

        return redirect()->route('dashboard.about.vision.index');
    }

    public function missionIndex()
    {
        $about = AboutMission::first();

        return view('dashboard.about.mission',compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function missionStore(Request $request)
    {
        $mission = AboutMission::updateOrCreate(
            ['id' => $request->id],
            $request->except('image','file','file1')
        );

        if ($request->hasFile('image')) {
            // First, clear any existing media if you're updating
            $mission->clearMediaCollection('about_mission');

            // Then, add the new files
            $mission->addMultipleMediaFromRequest(['image'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_mission');
            });
        }

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $mission->clearMediaCollection('about_mission_file');

            // Then, add the new files
            $mission->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_mission_file');
            });
        }
        if ($request->hasFile('file1')) {
            // First, clear any existing media if you're updating
            $mission->clearMediaCollection('about_mission_file1');

            // Then, add the new files
            $mission->addMultipleMediaFromRequest(['file1'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('about_mission_file1');
            });
        }


        return redirect()->route('dashboard.about.mission.index');
    }



}
