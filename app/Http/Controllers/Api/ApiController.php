<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\AboutVision;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\Home;
use App\Models\ProjectPage;
use App\Models\SingleProject;
use App\Models\SingleProjectUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
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
    public function blogs()
    {
        $blogs = Blog::with('descriptions')->get();

        return response()->json([
            'blogs'=>$blogs,
        ]);
    }

    public function about()
    {
        $about = About::get()->map(function ($home) {
            $home->Benefit = Benefit::get();
            $home->aboutVision = AboutVision::first();
            $home->aboutGallery = AboutGallery::get();

            return $home;
        });

        return response()->json([
            'about'=>$about,
        ]);
    }

    public function blog($id)
    {
        $blogs = Blog::with('descriptions')->where('id',$id)->get();

        return response()->json([
            'blogs'=>$blogs,
        ]);
    }

    public function projectPage()
    {
        $projectPage = ProjectPage::first();

        return response()->json([
            'project_page'=>$projectPage,
        ]);
    }

    public function projects()
    {
        $projectPage = SingleProject::with(['features','units'])->get();

        return response()->json([
            'project_page'=>$projectPage,
        ]);
    }

    public function project($id)
    {
        $projectPage = SingleProject::with(['features','units'])->where('id',$id)->get();

        return response()->json([
            'project_page'=>$projectPage,
        ]);
    }

    public function projectUnit($id)
    {
        $singleProjectUnit = SingleProjectUnit::with(['unitFeatures','project'])->where('id',$id)->get();

        return response()->json([
            'project_page_unit'=>$singleProjectUnit,
        ]);
    }


}
