<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPageRequest;
use App\Models\CareerPage;
use Illuminate\Http\Request;

class CareerPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $career = CareerPage::first();

        return view('dashboard.career.cover',compact('career'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectPageRequest $request)
    {
        $career = CareerPage::updateOrCreate(
            ['id' => $request->id],
            $request->except('file')
        );

        if ($request->hasFile('file')) {
            // First, clear any existing media if you're updating
            $career->clearMediaCollection('career_caver');

            // Then, add the new files
            $career->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('career_caver');
            });
        }

        return redirect()->route('dashboard.career.cover');
    }






}
