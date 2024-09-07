<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPageRequest;
use App\Http\Requests\TeamRequest;
use App\Models\MeetTeamPage;
use App\Models\ProjectPage;
use App\Models\Team;
use Illuminate\Http\Request;

class MeetTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::paginate(10);

        return view('dashboard.meet_team.team.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.meet_team.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $team = Team::create($request->except('file'));

        if ($request->hasFile('file'))
        {
            $team->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('team');
            });
        }
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'File uploaded successfully.']);
        }

        return redirect()->route('dashboard.meet_team.team.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $team = Team::find($id);

        return view('dashboard.meet_team.team.show',compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $team = Team::find($id);

        return view('dashboard.meet_team.team.edit',compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, int $id)
    {

        $team = Team::find($id);

        if ($request->hasFile('file'))
        {
            $team->clearMediaCollection('team');

            $team->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('team');
            });
        }

        $team->update($request->except('file'));

        return redirect()->route('dashboard.meet_team.team.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $team  = Team::find($id);

        $team->clearMediaCollection('team');

        $team->delete();

        return redirect()->route('dashboard.meet_team.team.index');
    }
}
