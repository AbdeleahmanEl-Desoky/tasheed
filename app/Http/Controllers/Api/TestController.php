<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutGallery;
use App\Models\AboutGalleryTranslation;
use App\Models\AboutMission;
use App\Models\AboutMissionTranslation;
use App\Models\AboutTranslation;
use App\Models\AboutVision;
use App\Models\AboutVisionTranslation;
use App\Models\ApplyJob;
use App\Models\Benefit;
use App\Models\BenefitTranslation;
use App\Models\Blog;
use App\Models\BlogDescription;
use App\Models\BlogDescriptionTranslation;
use App\Models\BlogPage;
use App\Models\BlogPageTranslation;
use App\Models\BlogTranslation;
use App\Models\Career;
use App\Models\CareerPage;
use App\Models\CareerPageTranslation;
use App\Models\CareerTranslation;
use App\Models\Contact;
use App\Models\ContactTranslation;
use App\Models\Feature;
use App\Models\FeatureTranslation;
use App\Models\FeatureUnit;
use App\Models\FeatureUnitTranslation;
use App\Models\Home;
use App\Models\HomeTranslation;
use App\Models\Job;
use App\Models\JobTranslation;
use App\Models\MeetTeamPage;
use App\Models\MeetTeamPageTranslation;
use App\Models\Message;
use App\Models\ProjectPage;
use App\Models\ProjectPageTranslation;
use App\Models\ProjectUnitFeature;
use App\Models\ProjectUnitFeatureTranslation;
use App\Models\SendEmail;
use App\Models\Seo;
use App\Models\SingleProject;
use App\Models\SingleProjectTranslation;
use App\Models\SingleProjectUnit;
use App\Models\SingleProjectUnitTranslation;
use App\Models\Team;
use App\Models\TeamTranslation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        // Fetching all translations and adding seo to each one
        $translations = [
            AboutGalleryTranslation::all(),
            AboutMissionTranslation::all(),
            AboutTranslation::all(),
            AboutVisionTranslation::all(),
            BenefitTranslation::all(),
            BlogPageTranslation::all(),
            BlogTranslation::all(),
            CareerPageTranslation::all(),
            CareerTranslation::all(),
            ContactTranslation::all(),
            FeatureTranslation::all(),
            FeatureUnitTranslation::all(),
            JobTranslation::all(),
            MeetTeamPageTranslation::all(),
            ProjectPageTranslation::all(),
            SingleProjectTranslation::all(),
            SingleProjectUnitTranslation::all(),
            TeamTranslation::all(),
        ];
        foreach ($translations as $translationCollection) {
            foreach ($translationCollection as $translation) {
                // Create the SEO data (you can customize this logic)
                $seo = Seo::create([
                    'title' => 'SEO Title for ' . class_basename($translation),  // Custom logic for title
                    'description' => 'SEO Description for ' . class_basename($translation),  // Custom logic for description
                    'tags' => 'SEO Tags for ' . class_basename($translation),  // Custom logic for tags
                ]);

                // Associate the SEO data with the translation (polymorphic relationship)
                $translation->seo()->save($seo);
            }
        }

        return 'done';
    }
}
