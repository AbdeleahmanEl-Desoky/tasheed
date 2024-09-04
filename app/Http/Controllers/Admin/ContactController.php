<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::first();

        // Decode the JSON field 'call_us' to a PHP array
        if ($contact && $contact->call_us) {
            $contact->call_us = json_decode($contact->call_us, true);  // Decode JSON to array
        }

        return view('dashboard.contact.index', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'required|string',
            'visit_us' => 'required|string',
            'email_us' => 'required|string',
            'call_us' => 'required|array', // Ensure call_us is an array
            'call_us.*' => 'string', // Validate each call_us entry as a string
        ]);

        // Prepare the data for creating or updating the Contact instance
        $data = $request->except(['file', 'contact_1', 'contact_2', 'contact_3', 'contact_4']);

        $data['call_us'] = json_encode($request->call_us);  // Encode call_us to JSON

        // Update or create the Contact instance
        $contact = Contact::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        // Handle media uploads for multiple file inputs
        $mediaInputs = ['contact_1', 'contact_2', 'contact_3', 'contact_4'];
        foreach ($mediaInputs as $inputName) {
            if ($request->hasFile($inputName)) {
                $contact->clearMediaCollection($inputName);
                $contact->addMultipleMediaFromRequest([$inputName])->each(function ($fileAdder) use ($inputName) {
                    $fileAdder->toMediaCollection($inputName);
                });
            }
        }

        return redirect()->route('dashboard.contact.index');
    }
}
