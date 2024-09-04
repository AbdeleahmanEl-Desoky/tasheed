<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\AboutVision;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Contact;
use App\Models\Home;
use App\Models\Job;
use App\Models\Message;
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
        $blog = Blog::with('descriptions')->where('id',$id)->first();

        return response()->json([
            'blog'=>$blog,
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
            'projects'=>$projectPage,
        ]);
    }

    public function project($id)
    {
        $projectPage = SingleProject::with(['features','units'])->where('id',$id)->first();

        return response()->json([
            'project'=>$projectPage,
        ]);
    }

    public function projectUnit($id)
    {
        $singleProjectUnit = SingleProjectUnit::with(['unitFeatures','project'])->where('id',$id)->first();

        return response()->json([
            'project_unit'=>$singleProjectUnit,
        ]);
    }

    public function contact()
    {
        $contact = Contact::first();

        // Decode the JSON field 'call_us' to a PHP array
        if ($contact && $contact->call_us) {
            $contact->call_us = json_decode($contact->call_us, true);  // Decode JSON to array
        }

        return response()->json([
            'contact'=>$contact,
        ]);
    }

    public function message(Request $request)
    {
        $message = Message::create($request->all());


        return response()->json([
            'message'=>$message,
        ]);
    }

    public function careers()
    {
        $careers = Career::with('jobs')->get();


        return response()->json([
            'careers'=>$careers,
        ]);
    }

    public function job($id)
    {
        $job = Job::whereId($id)->first();

        return response()->json([
            'job'=>$job,
        ]);
    }
}
