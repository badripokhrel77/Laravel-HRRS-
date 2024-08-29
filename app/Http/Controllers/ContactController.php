<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMail;


class ContactController extends Controller
{
    function contact()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        //Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Prepare data for the email
        $contactData = $request->only('name', 'email','phone', 'message');

        // Send email
        Mail::to('badripokhrel.77@gmail.com')->send(new ContactMail($contactData));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
