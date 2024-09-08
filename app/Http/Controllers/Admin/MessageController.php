<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Requests\Request;
use App\Models\ApplyJob;
use App\Models\Career;
use App\Models\Job;
use App\Models\Message;
use App\Models\SendEmail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function message()
    {
        $messages = Message::paginate(10);

        return view('dashboard.message.contact', compact('messages'));
    }

    public function applyJob()
    {
        $messages = ApplyJob::paginate(10);

        return view('dashboard.message.applyJob', compact('messages'));
    }


    public function emils()
    {
        $messages = SendEmail::paginate(10);

        return view('dashboard.message.emils', compact('messages'));
    }

}
