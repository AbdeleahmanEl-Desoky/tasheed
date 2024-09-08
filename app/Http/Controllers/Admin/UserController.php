<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->except('image'));

        $request->password = bcrypt($request->password);

        if ($request->hasFile('image'))
        {
            $user->addMultipleMediaFromRequest(['image'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('user');
            });
        }

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::find($id);

        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, int $id)
    {
        $user = User::find($id);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('image'))
        {
            $user->addMultipleMediaFromRequest(['image'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('user');
            });
        }

        $user->update($request->except('image'));

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('dashboard.users.index');
    }
}
