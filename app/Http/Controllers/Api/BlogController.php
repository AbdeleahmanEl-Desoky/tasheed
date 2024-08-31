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

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('descriptions')->get();

        return response()->json([
            'blogs'=>$blogs,
        ]);
    }


}
