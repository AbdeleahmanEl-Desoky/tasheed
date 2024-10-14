<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\AboutMission;
use App\Models\AboutVision;
use App\Models\ApplyJob;
use App\Models\Benefit;
use App\Models\Blog;
use App\Models\BlogPage;
use App\Models\Career;
use App\Models\CareerPage;
use App\Models\Contact;
use App\Models\Home;
use App\Models\Job;
use App\Models\MeetTeamPage;
use App\Models\Message;
use App\Models\ProjectPage;
use App\Models\SendEmail;
use App\Models\SingleProject;
use App\Models\SingleProjectUnit;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function index()
    {
        $home = Home::get();
        $about = About::get()->map(function ($home) {
            $home->aboutGallery = AboutGallery::get();
            return $home;
        });

        $singleProject = SingleProject::where('type','ongoing')->get()
        ->map(function($project) {
            $madia = $project->getMedia('singleFirstCaver');

            $project->setRelation('media', $madia);

            return $project;
        });

        $featureProject = SingleProject::where('type','featured')->get()
        ->map(function($project) {
            $madia = $project->getMedia('singleFirstCaver');

            $project->setRelation('media', $madia);

            return $project;
        });


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
        $caver = BlogPage::first();
        $blogs = Blog::with('descriptions')->get();

        return response()->json([
            'caver' => $caver,
            'blogs'=>$blogs,
        ]);
    }

    public function about()
    {
        $about = About::get()->map(function ($about) {
            $about->Benefit = Benefit::get();
            $about->aboutVision = AboutVision::first();
            $about->aboutGallery = AboutGallery::get();
            $about->mission = AboutMission::first();
            $about->ongoing = SingleProject::where('type','ongoing')->get()
            ->map(function($project) {
                $madia = $project->getMedia('singleFirstCaver');

                $project->setRelation('media', $madia);

                return $project;
            });
            
            return $about;
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
        $projectPage = SingleProject::with(['features','units','media'])->get()
        ->map(function($project) {
            $madia = $project->getMedia('singleFirstCaver');

            $project->setRelation('media', $madia);

            return $project;
        });


        return response()->json([
            'projects'=>$projectPage,
        ]);
    }

    public function project($id)
    {
        $projects = SingleProject::with(['features', 'units', 'media'])
            ->where('id', $id)
            ->get()
            ->map(function($project) {
                $madia = $project->getMedia('singleProjectGallery');


                $project->setRelation('media', $madia);

                return $project;
            });

            $coverMedia = SingleProject::with(['features', 'units', 'media'])
            ->where('id', $id)
            ->get()
            ->map(function($project) {
                $madia = $project->getMedia('singleProjectCaver');


                $project->setRelation('media', $madia);

                return $project;
            });

            // Assuming the cover media is retrieved using Spatie's Media Library
            $mediaItem = $coverMedia->first() ;

            return response()->json([
                'project' => $projects->first(),
                'cover' => $mediaItem
            ]);
    }

    public function projectUnit($id)
    {
        $singleProjectUnit = SingleProjectUnit::with(['unitFeatures', 'project'])
            ->where('id', $id)
            ->first();

        if ($singleProjectUnit) {
            // Decode JSON data
            $singleProjectUnit->data = json_decode($singleProjectUnit->data, true);

            // Return the response with the decoded data
            return response()->json([
                'project_unit' => $singleProjectUnit,
            ]);
        } else {
            // Handle the case where the project unit is not found
            return response()->json([
                'error' => 'Project unit not found',
            ], 404);
        }
    }
    public function contact()
    {
        $contact = Contact::first();

        // Decode the JSON field 'call_us' to a PHP array
        if ($contact && $contact->call_us) {
            $contact->call_us = json_decode($contact->call_us, true);  // Decode JSON to array
        }

        // Decode the JSON field 'visit_us' to a PHP array
        if ($contact && $contact->visit_us) {
            $contact->visit_us = json_decode($contact->visit_us, true);  // Decode JSON to array
        }



        return response()->json([
            'contact'=>$contact,
        ]);
    }

    public function message(Request $request)
    {
        $message = Message::create($request->all());

        $contact = Contact::whereNot('crm_general',null)->first();

        $data = [
            'name'          => $message->full_name,
            'email'         => $message->email,
            'mobile'         => $message->phone,
        ];

        if($request->has('from_project') ){
            $singleProject = SingleProject::where('id', $request->from_project)->whereNot('crm_api', null)->first();
            if($singleProject){
                $response = Http::post($singleProject->crm_api, $data);
            }elseif($contact){
                $response = Http::post($contact->crm_general, $data);
            }
        }elseif($contact){
            $response = Http::post($contact->crm_general, $data);
        }

        // Optionally, check if the request was successful
        if ($response->successful()) {
            return response()->json([
                'message' => $message,
                'api_response' => $response->json(),
            ]);
        }


        return response()->json([
            'message'=>$message,
        ]);
    }

    public function careers()
    {
        $careerPage = CareerPage::first();
        $careers = Career::with('jobs')->get();

        return response()->json([
            'career_cover' => $careerPage,
            'careers' => $careers,
        ]);
    }

    public function job($id)
    {
        $job = Job::whereId($id)->first();

        return response()->json([
            'job'=>$job,
        ]);
    }

    public function applyJob(Request $request)
    {
        $applyJob = ApplyJob::create($request->except('file'));


        if ($request->hasFile('file')) {
            $applyJob->addMedia($request->file('file'))->toMediaCollection('applyJob');
        }


        return response()->json([
            'applyJob'=> $applyJob,
        ]);
    }

    public function team()
    {
        $meetTeamPage = MeetTeamPage::first();

        $ourTeam = Team::where('in_page',1)->get();

        $teams = Team::where('in_page',0)->get();

        return response()->json([
            'meet_team_page'=>$meetTeamPage,
            'our_team' => $ourTeam,
            'teams' => $teams,
        ]);
    }

    public function email(Request $request)
    {
        $sendEmail = SendEmail::create([
            'email' => $request->email
        ]);

        return response()->json([
            'sendEmail'=>$sendEmail,
        ]);

    }

}
