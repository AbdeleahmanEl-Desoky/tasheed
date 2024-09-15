<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SingleProject;
use App\Models\SingleProjectUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $units = SingleProjectUnit::count();
        $projects = SingleProject::count();

        return view('dashboard.welcome',compact('users_count','units','projects'));
    }


}
