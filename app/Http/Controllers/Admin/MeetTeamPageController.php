<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPageRequest;
use App\Models\MeetTeamPage;
use App\Models\ProjectPage;
use Illuminate\Http\Request;

class MeetTeamPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meet = MeetTeamPage::first();

        return view('dashboard.meet_team.index',compact('meet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectPageRequest $request)
    {
        $about = MeetTeamPage::updateOrCreate(
            ['id' => $request->id],
            $request->except('file')
        );

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $about->clearMediaCollection('meet_team_caver');

            // Then, add the new files
            $about->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('meet_team_caver');
            });
        }

        return redirect()->route('dashboard.meet_team.index');
    }






}
