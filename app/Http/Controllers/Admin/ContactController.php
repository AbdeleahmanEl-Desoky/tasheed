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

        if ($contact && $contact->visit_us) {
            $contact->visit_us = json_decode($contact->visit_us, true);  // Decode JSON to array
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
            'email_us' => 'required|string',
            'call_us' => 'required|array',
            'call_us.*' => 'string',
            'visit_us' => 'required|array',
            'visit_us.*.visit_us' => 'string|required', // Validate visit_us entries
            'visit_us.*.visit_link' => 'string|nullable', // Validate visit_link entries
        ]);

        // Prepare the data
        $data = $request->except(['file', 'contact_1', 'contact_2', 'contact_3', 'contact_4']);
        $data['call_us'] = json_encode($request->call_us);
        $data['visit_us'] = json_encode($request->visit_us);  // Store visit_us and visit_link as JSON

        // Update or create the Contact instance
        $contact = Contact::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        // Handle file uploads
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
