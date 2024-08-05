<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest;
use App\Models\Home;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homes = Home::paginate(10);

        return view('dashboard.home.index',compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeRequest $request)
    {
        $home = Home::create($request->except('file'));

        if ($request->hasFile('file'))
        {
            $home->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('home_caver');
            });
        }

        return redirect()->route('dashboard.home.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $home = Home::find($id);

        return view('dashboard.home.show',compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $home = Home::find($id);

        return view('dashboard.home.edit',compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomeRequest $request, int $id)
    {
        $home = Home::find($id);

        if ($request->hasFile('file'))
        {
            $home->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('home');
            });
        }

        $home->update($request->except('file'));

        return redirect()->route('dashboard.home.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $home  = Home::find($id);

        $home->delete();

        return redirect()->route('dashboard.home.index');
    }
}
