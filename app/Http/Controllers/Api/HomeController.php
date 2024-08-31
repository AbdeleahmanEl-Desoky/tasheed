<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\Blog;
use App\Models\Home;
use App\Models\SingleProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::get();
        $about = About::get()->map(function ($home) {
            $home->aboutGallery = AboutGallery::get();
            return $home;
        });

        $singleProject = SingleProject::where('type','ongoing')->get();
        $featureProject = SingleProject::where('type','feature')->get();
        $blogs = Blog::get();


        return response()->json([
            'home'=>$home,
            'about'=>$about,
            'blogs' => $blogs,
            'singleProject'=>$singleProject,
            'featureProject'=>$featureProject,
        ]);
    }


}
